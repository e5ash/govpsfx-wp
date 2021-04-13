<?php

//навигация страниц
function page_navigation($query,$count,&$page,&$total)
{
    global $wpdb;   
    $result = $wpdb->get_results($query);
    $count_result = count($result);
    $total = intval(($count_result - 1) / $count) + 1;
    $page = intval($page);
    if(empty($page) or $page < 0) $page = 1; 
    if($page > $total) $page = $total;
    $start = $page * $count - $count; 
    $wpdb->query("SET @num:=$start");
    $result = $wpdb->get_results($query . " LIMIT $start, $count");
    return $result;   
}

//меню навигации страниц
function page_navigation_menu($page, $total,$hr, $p = 'pg')
{    
    ob_start();    
    if ($page != 1) $pervpage = '<a href= ' . $hr . "?$p=1><<</a><a href= " . $hr .($page - 1) .'><</a> '; 
    if ($page != $total) $nextpage = ' <a href= ' . $hr . "?$p=" . ($page + 1) . '>></a><a href= ' . $hr . $total . '>>></a>'; 
    if($page - 2 > 0) $page2left = ' <a href= ' . $hr . "?$p=" . ($page - 2) . '>' . ($page - 2) .'</a> | ';
    if($page - 1 > 0) $page1left = '<a href= ' . $hr . "?$p=" .($page - 1) .'>'. ($page - 1) .'</a> | ';
    if($page + 2 <= $total) $page2right = ' | <a href= ' . $hr . "?$p=" . ($page + 2) .'>'. ($page + 2) .'</a>';
    if($page + 1 <= $total) $page1right = ' | <a href= ' . $hr . "?$p=" . ($page + 1) .'>'. ($page + 1) .'</a>';

    echo $pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage;  
    $output = ob_get_clean(); return $output;
}

//формат котировок
function pairDbFormat($pair)
{
    $pair = strtoupper($pair);
    $pair = str_replace("-", "/", $pair); 
    return $pair;
}

//проверка на вредоносные символы
function CheckUserData($var)
{
    global $wpdb;
    $res = htmlspecialchars($var, ENT_QUOTES);
    $res = $wpdb->prepare($res, []);
    return $res;  
}
