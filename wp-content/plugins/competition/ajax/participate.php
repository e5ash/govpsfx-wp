<?php
if (empty($_POST['pair'])) {
    $answer = [
        'status' => 'error',
        'error' => 'отсутствует параметр pair'
    ];
    echo json_encode($answer); 
    exit;
}
if (empty($_POST['forecast'])) {
    $answer = [
        'status' => 'error',
        'error' => 'прогноз не введен'
    ];
    echo json_encode($answer);
    exit;
}
if (empty($_POST['uuid'])) {
    $answer = [
        'status' => 'error',
        'error' => 'отсутствует параметр pair'
    ];
    echo json_encode($answer);
    exit;
}
$pair = $wpdb->prepare(htmlspecialchars($_POST['pair'], ENT_QUOTES));
$forecast = $wpdb->prepare(htmlspecialchars($_POST['forecast'], ENT_QUOTES));
$uuid = $wpdb->prepare(htmlspecialchars($_POST['uuid'], ENT_QUOTES));
//forecast
if (!is_numeric($forecast)) {
    $answer = [
        'status' => 'error',
        'error' => 'введите корректный прогноз'
    ];
    echo json_encode($answer);
    exit;
}
//uuid 
$pattern = "/[a-zA-Z0-9]{12,20}$/";
if (!(preg_match($pattern, $uuid)))
{
     $answer = [
        'status' => 'error',
        'error' => 'неверный uuid'
    ];
    echo json_encode($answer);
    exit;
}


//mygovpsfx.com
//определение ip
$ip = $_SERVER['REMOTE_ADDR'];
//параметры
$params = array(
    'forecast' => $forecast,
    'uuid' => $uuid,
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
$result = file_get_contents('https://admin.govpsfx.com/competition.php', false, $context); //отправляем запрос   
$resultParse = json_decode($result, true);
$statusAnswer = $resultParse['code'];
if ($statusAnswer === 1) {
    $countParticipants = $resultParse['count_participants'];
    $userName = $resultParse['user_name'];
    $countSql = $wpdb->get_var("select count(*) as count from competition_participants where pair = '$pair'");
    $wpdb->insert(
        'wp_competition_participants',
        array( 'nick' => $userName, 'uuid' => $uuid, 'forecast' => $forecast, 'pair' => $pair),
        array( '%s', '%s', '%f', '%s' )
    );    
}


echo $result;
exit;



