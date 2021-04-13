<?php

/*
Plugin Name: Competition Forex
Description: Конкурсная площадка
*/
require_once("functions.php");

function competition_forex_registration_function($atts)
{
   ob_start(); 
   global $wpdb; 
   
   include 'design/competition-forex.php';
   $output = ob_get_clean(); return $output;
}
add_shortcode('competition-forex-registration', 'competition_forex_registration_function');

function competition_forex_participants_function($atts)
{
    ob_start();
    global $wpdb;
    require_once('functions/functions.php');
    //page	
    $page = CheckUserData($_GET['pg']);
    if (empty($page)) {
       $page = 1; 
    }
    $query = "select @num := @num+1 as num, wp_forex_competition_participants.* from wp_forex_competition_participants where balance is not null and status = 1 order by balance desc";
    $participants = page_navigation($query,20,$page,$total);
    $pageNavigationMenu = page_navigation_menu($page, $total,get_permalink());
    include 'design/participants-forex.php';
    $output = ob_get_clean(); return $output;
}
add_shortcode('competition-forex-participants', 'competition_forex_participants_function');

function competition_forex_count_function($atts)
{
    ob_start();
    global $wpdb;
    require_once('functions/formatCount.php');
    $countParticipants = $wpdb->get_var("select count(*) from wp_forex_competition_participants where status = 1 and balance is not null");
    if (!$countParticipants) {
        $countParticipants = 0;
    }
    $digits = formatCount($countParticipants);
    include 'design/count.php';
    $output = ob_get_clean(); return $output;
}
add_shortcode('competition-forex-count', 'competition_forex_count_function');

function forex_participate()
{
    global $wpdb; 
    require_once('ajax/participate.php');
}
add_action('wp_ajax_forex_participate', 'forex_participate');
add_action('wp_ajax_nopriv_forex_participate', 'forex_participate');

//получение данных для графика Ajax
function grafdate_get()
{
   global $wpdb;
   require_once('ajax/graphdate_get.php');
}
add_action('wp_ajax_grafdate_get', 'grafdate_get');
add_action('wp_ajax_nopriv_grafdate_get', 'grafdate_get');

function forex_competition_activate() 
{
    global $wpdb;
    $tableName = $wpdb->prefix . 'forex_competition_participants';
    if($wpdb->get_var("SHOW TABLES LIKE '$tableName'") != $tableName)
    {
        $sql = "CREATE TABLE " . $tableName . "(
            `id` int(11) NOT NULL AUTO_INCREMENT, 
            `account` text NOT NULL,
            `uuid` text NOT NULL,
            `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
               );"; 
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);
    }
    
}
register_activation_hook( __FILE__, 'forex_competition_activate' );

