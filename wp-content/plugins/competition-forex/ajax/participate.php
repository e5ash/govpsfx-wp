<?php

if (empty($_POST['account'])) {
    $answer = [
        'code' => 6,
        'message' => 'отсутствует параметр account'
    ];
    echo json_encode($answer); 
    exit;
}
if (empty($_POST['uuid'])) {
    $answer = [
        'code' => 6,
        'message' => 'отсутствует параметр uuid'
    ];
    echo json_encode($answer); 
    exit;
}
$account = $wpdb->prepare(htmlspecialchars($_POST['account'], ENT_QUOTES));
$uuid = $wpdb->prepare(htmlspecialchars($_POST['uuid'], ENT_QUOTES));
$pattern = "/[a-zA-Z0-9]{12,20}$/";
if (!(preg_match($pattern, $uuid)))
{
     $answer = [
        'code' => 6,
        'message' => 'неверный uuid'
    ];
    echo json_encode($answer);
    exit;
}

$results = $wpdb->get_results( 
    $wpdb->prepare("SELECT uuid FROM {$wpdb->prefix}forex_competition_participants WHERE uuid = %s",$uuid) 
    );
if ($results) {
   $result = [
      "code" => 3,
      "message" => "repeat uuid"
   ];
   echo json_encode($result);
   exit;
}
$ip = $_SERVER['REMOTE_ADDR'];
$params = array(
    'account' => $account,
    'uuid' => $uuid,
    'ip'   => $ip
);
$vars = http_build_query($params);
$options = array(
    'http' => array(  
                'method'  => 'POST',  // метод передачи данных
                'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок 
                'content' => $vars,  // переменные
              )  
);
$context  = stream_context_create($options); 
$urlApi = get_option('go_backoffice_url') . '/competition-api/participate';
$result = file_get_contents($urlApi, false, $context);
if (!$result) {
    /*
    $answer = [
        'code' => 5,
        'message' => 'ошибка'
    ];
     * 
     */
     $answer = [
        'code' => 6,
        'message' => $urlApi
    ];
    echo json_encode($answer); 
    exit;
}
$resultParse = json_decode($result, true);
$statusAnswer = $resultParse['code'];
if ($statusAnswer === 1) {
    $userName = $resultParse['user_name'];
    $wpdb->insert(
        $wpdb->prefix . 'forex_competition_participants',
        array( 'nick' => $userName, 'uuid' => $uuid, 'account' => $account, 'status' => 1),
        array( '%s', '%s', '%s')
    );
}

echo $result;
exit;



