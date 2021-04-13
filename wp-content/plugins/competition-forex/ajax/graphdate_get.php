<?php

$account = $_POST['account'];
$data = array();
if (empty($account)) {
    return $data;
    exit;
}
$results = $wpdb->get_results("SELECT account, balance, date_server FROM wp_forex_competition_statistic WHERE account = $account");

foreach ($results as $result) {
   $data[] = $result;
}

echo json_encode($data);
exit;
