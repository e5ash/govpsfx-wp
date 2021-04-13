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
    $result = $wpdb->get_results($query . " LIMIT $start, $count");
    return $result;   
}

//меню навигации страниц
function page_navigation_menu($page, $total,$hr, $pair, $p = 'pg')
{    
    ob_start(); 
    if ($page != 1) $pervpage = "<a href= '$hr?pair=$pair&$p=1' class='content__search-letter'><<</a><a href= '$hr".($page - 1)."' class='content__search-letter'><</a> ";
    if ($page != $total) $nextpage = " <a href= '$hr?pair=$pair&$p=".($page + 1)."' class='content__search-letter'>></a><a href= '{$hr}{$total}' class='content__search-letter'>>></a>";
    if ($page - 2 > 0) $page2left = " <a href= '$hr?pair=$pair&$p=".($page - 2)."' class='content__search-letter'>".($page - 2)."</a>";
    if ($page - 1 > 0) $page1left = "<a href= ' $hr?pair=$pair&$p=".($page - 1)."' class='content__search-letter'>".($page - 1)."</a>";
    if ($page + 2 <= $total) $page2right = " <a href= '$hr?pair=$pair&$p=".($page + 2)."' class='content__search-letter'>".($page + 2)."</a>";
    if($page + 1 <= $total) $page1right = " <a href= '$hr?pair=$pair&$p=".($page + 1)."' class='content__search-letter'>".($page + 1)."</a>";
    $page="<strong><span class='content__search-letter'>$page</span></strong>";
    echo $pervpage.$page2left.$page1left.$page.$page1right.$page2right.$nextpage;  
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
