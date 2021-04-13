<?php
PHP_SAPI === 'cli' or die('Web access restricted!');

require_once('config.php');
require_once('config-cron.php');
require_once('functions/Quotes/QuotesBitcoin.php');
require_once('functions/FileLogger.php');
require_once('exceptions/QuotesException.php');
require_once('exceptions/DbException.php');

function setTime()
{
    $today = getdate();
    if ($today['hours'] >= 0 && $today['hours'] <= 8) {
    	$min = mt_rand(1, 240);
    } else {
    	$min = mt_rand(1, 50);
    }
    $forecastTime = time() + $min*60;
    return $forecastTime;
}
$host = $config_cron['host'];
$login = $config_cron['login'];
$pass = $config_cron['pass'];
$base = $config_cron['base'];
$hostApi = $competitionApi['host'];

try {   
     //проверка дня недели
     $today = getdate();  
     if (($today['wday'] === 5 && $today['hours'] >= 23) || ($today['wday'] === 6) || ($today['wday'] === 0)) {
    	die();
     }
    //соединение с базой
    $mysqli = new mysqli($host, $login, $pass, $base);
    if ($mysqli->connect_errno) {	
        throw new DbException("no connection");
    }
    $mysqli->autocommit(FALSE);   
	$pair = 'bitcoin';
    //проверка времени
    $time = time();
    $result = $mysqli->query("SELECT forecast_time from wp_competition_options where pair = '$pair'");
    $row = $result->fetch_object();
    $forecastTime = $row->forecast_time;  
    if (empty($forecastTime)) {
        $forecastTime = setTime();
        $result = $mysqli->query("INSERT INTO wp_competition_options (forecast_time, pair) VALUES($forecastTime, '$pair')");
        $mysqli->commit();
        return true;
    }
    if ($time < $forecastTime) {
	echo 'Time has not yet come';
        return true;
    }
    //получение участников из базы  
	$result = $mysqli->query("SELECT wb.id, wb.nick, wb.uuid, wbd.pair FROM wp_competition_base wb LEFT JOIN wp_competition_bots_done wbd ON wb.id = wbd.base_id WHERE wbd.pair is NULL OR wbd.pair <> '$pair' ORDER BY wb.id"); 
    if (empty($result->num_rows)) {   
        throw new DbException('no competitors');
    }
    while ($row = $result->fetch_object()){
        $participants[]= $row;			
    }  
    $countParticipants = count($participants);
    $index = mt_rand(0, $countParticipants-1);
    $participant = $participants[$index];
    //прогноз
    $quotesClass = new QuotesBitcoin();
    $quotes = $quotesClass->get();
    if (empty($quotes)) {
        throw new QuotesException('no quotes');       
    }
    $difference = (mt_rand(0, 60)-30)/100;
    $forecast = $quotes + $difference;
    //mygovpsfx.com
    //определение ip
    $ip = $_SERVER['REMOTE_ADDR'];
    //параметры
    $params = array(
        'forecast' => $forecast,
        'uuid' => $participant->uuid,
        'pair' => $pair,
        'ip'   => $ip
    );       
    // преобразуем массив в URL-кодированную строку
    $vars = http_build_query($params);
    // создаем параметры контекста
    $options = array(
        'http' => array(  
            'method'  => 'POST',  // метод передачи данных
            'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок 
            'content' => $vars,  // переменные
          )  
    ); 
    $context  = stream_context_create($options);  // создаём контекст потока
    $result = file_get_contents("$hostApi/competition.php", false, $context); //отправляем запрос   
    $resultParse = json_decode($result, true);
    $statusAnswer = $resultParse['code'];
    if ($statusAnswer === 1) {
        //$countParticipants = $resultParse['count_participants'];
        $userName = $resultParse['user_name'];
        //$countSql = $wpdb->get_var("select count(*) as count from competition_participants where pair = '$pair'");       
        $result = $mysqli->query("INSERT into wp_competition_participants (nick, uuid, forecast, pair) values ('$userName', '$participant->uuid', $forecast, '$pair' )");           
    } else {
        $mysqli->rollback();
        $mysqli->autocommit(TRUE);
	$result = $mysqli->query("INSERT into wp_competition_bots_done (base_id, pair) values ($participant->id, '$pair')");
        return false;
    }
    //обновление статуса участника
    $result = $mysqli->query("INSERT into wp_competition_bots_done (base_id, pair) values ($participant->id, '$pair')");
    //время
    $forecastTime = setTime();
    $result = $mysqli->query("UPDATE wp_competition_options set forecast_time = $forecastTime where pair = '$pair'");     
    $mysqli->commit();
    return true;
} catch (DbException $e) {     
    FileLogger::log('database', $e->getMessage(), 'forecast');
} catch (QuotesException $e) {   
    FileLogger::log('quotes', $e->getMessage(), 'forecast');
}
