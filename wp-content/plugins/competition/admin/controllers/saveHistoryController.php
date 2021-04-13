<?php
function errorDb($errorMessage = null)
{
    echo "Ошибка БД: $errorMessage";
    return;    
}

if ($_POST['save-history']) {
    //echo 'eur_usd';
    $eurUsd = $_POST["eur_usd"];
    $gbpUsd = $_POST["gbp_usd"];
    try {
        $result = $wpdb->query('START TRANSACTION');
        //Удаление из истории
        $result = $wpdb->query('TRUNCATE TABLE wp_competition_history');
        if ($result===false) {
            return errorDb("Ошибка очистки истории");
        }
        //Получение участников конкурса
        $query = "SELECT nick, uuid, forecast, pair, date FROM wp_competition_participants";
        $result = $competitionParticipants = $wpdb->get_results($query);
        if ($result===false) {
            return errorDb("Получение участников конкурса");
        }
        if (empty($result)){
           echo "участников нет";
           return;
        }
        //var_dump($competitionParticipants);
        //die();
        $query = "INSERT INTO wp_competition_history (nick, uuid, forecast, pair, draw_number, date) VALUES ";
        //Запись в историю
        foreach($competitionParticipants as $participant)
        {
            $query .= "('{$participant->nick}','{$participant->uuid}',{$participant->forecast},'{$participant->pair}',NULL,'{$participant->date}'),";
        }
        $query = substr($query, 0, -1);  
        //var_dump($query);
        //die();
        $result = $wpdb->query($query);
        //var_dump($result);
        //die();
        if ($result===false) {
            return errorDb("Запись в историю");
        }
        //установление номеров розыгрышей
        $result = $wpdb->update("wp_competition_history",
            array("draw_number" => $eurUsd),
            array("pair" => "EUR/USD"),
            array('%s')
        );
        if ($result===false) {
            return errorDb("Установление номеров розыгрышей");
        }
        $result = $wpdb->update("wp_competition_history",
            array("draw_number" => $gbpUsd),
            array("pair" => "GBP/USD"),
            array('%s')
        ); 
        if ($result===false) {
            return errorDb("Установление номеров розыгрышей");
        }
        //Удаление участников конкурса
        $result = $wpdb->query('TRUNCATE TABLE wp_competition_participants');
        if (!$result) {
            return errorDb("Удаление участников конкурса");
        }
        //Обнуление ботов
        $query = "UPDATE wp_competition_base SET is_done = NULL";
        $result = $wpdb->query($query);
        if ($result===false) {
            return errorDb("Обнуление ботов основной базы");
        }
        echo $wpdb->error;
        //die();
        $query = "TRUNCATE TABLE wp_competition_bots_done";
        $result = $wpdb->query($query);
        if ($result===false) {
            return errorDb("Обнуление ботов");
        }
        //Обнуление опций
        $query = "UPDATE wp_competition_options SET forecast_time = 1";
        $result = $wpdb->query($query);
        if ($result===false) {
            return errorDb("Обнуление опций");
        }
        //$wpdb->query('COMMIT');
        echo 'Успешная запись в историю';
        //if( ! empty($wpdb->error) ) echo( $wpdb->error );
        
    } catch (Exception $ex) {
        $wpdb->query('ROLLBACK');
    }
    
    
    
} else {
    require_once("$views/save-history.php");
}


