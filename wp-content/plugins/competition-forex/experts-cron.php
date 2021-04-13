<?php
$www_path = realpath(dirname(__FILE__).'/../../../');
$_SERVER["DOCUMENT_ROOT"] = $www_path;
require($_SERVER['DOCUMENT_ROOT'].'/wp-config-forex.php');

$mysqli = new mysqli(DB_HOST_FOREX, DB_USER_FOREX, DB_PASSWORD_FOREX, DB_NAME_FOREX);
if ($mysqli->connect_error)
{
   echo "Ошибка подключения";
}
//$result = $mysqli->query("SELECT acc_num,balance,date_time FROM contest1 GROUP BY acc_num ORDER BY date_time desc");
//$result = $mysqli->query("SELECT acc_num,balance,date_time FROM contest1 GROUP BY acc_num HAVING MAX(date_time)");
$result = $mysqli->query(
        "SELECT c.acc_num,c.balance,c.equity,c.date_time
         FROM contest1 c 
         INNER JOIN (
            SELECT acc_num,balance,MAX(date_time) as date_time 
            FROM contest1 
            GROUP BY acc_num
         ) AS max USING (acc_num,date_time )");
if ($mysqli->error){
   echo "ошибка $mysqli->error";
   return;
}
/*
while ($row = $result->fetch_object()) {
   $mysqli->query(
        "INSERT INTO experts_statistic (account,balance,equity,date_updated,date_server)
         SELECT * FROM (SELECT {$row->acc_num}, {$row->balance}, {$row->equity}, now(), '{$row->date_time}') AS tmp
         WHERE NOT EXISTS (
            SELECT account 
            FROM experts_statistic 
            WHERE account={$row->acc_num} AND date_server='{$row->date_time}'
         ) LIMIT 1");
    if ($mysqli->error){
        echo "ошибка $mysqli->error";
        return;
    }
}
 * 
 */
while ($row = $result->fetch_object()) {
   $mysqli->query(
        "INSERT INTO experts_statistic (account,balance,equity,date_updated,date_server)
         SELECT {$row->acc_num}, {$row->balance}, {$row->equity}, now(), '{$row->date_time}' FROM DUAL 
         WHERE NOT EXISTS (
            SELECT account 
            FROM experts_statistic 
            WHERE account={$row->acc_num} AND date_server='{$row->date_time}'
         ) LIMIT 1");
    if ($mysqli->error){
        echo "ошибка $mysqli->error";
        return;
    }
}