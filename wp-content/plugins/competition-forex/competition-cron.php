<?php
//PHP_SAPI === 'cli' or die('Web access restricted!');
require_once('config-cron.php');

$current_host = $current_base['host'];
$current_login = $current_base['login'];
$current_pass = $current_base['pass'];
$current_base = $current_base['base'];

$forex_host = $forex_base['host'];
$forex_login = $forex_base['login'];
$forex_pass = $forex_base['pass'];
$forex_base = $forex_base['base'];

$current_mysqli = new mysqli($current_host, $current_login, $current_pass, $current_base);
$forex_mysqli = new mysqli($forex_host, $forex_login, $forex_pass, $forex_base);

$result = $forex_mysqli->query("SELECT acc_num,balance,equity, drawdoun, op_pos, cl_pos, date_time FROM contest1");

while ($row = $result->fetch_object()) {
   $res = $current_mysqli->query("SELECT account FROM wp_forex_competition_participants WHERE account = {$row->acc_num}");
   if ($res) {
        $current_mysqli->query("UPDATE wp_forex_competition_participants set balance = {$row->balance}, equity = {$row->equity}, 
                                date_server = '{$row->date_time}', drawdoun = {$row->drawdoun}, op_pos = {$row->op_pos}, cl_pos = {$row->cl_pos},  date_updated = now() WHERE account = {$row->acc_num}"); 
        $current_mysqli->query("INSERT INTO wp_forex_competition_statistic values(null, {$row->acc_num}, {$row->balance}, now(), '{$row->date_time}' )");
      //var_dump($current_mysqli->error);
   }
}

