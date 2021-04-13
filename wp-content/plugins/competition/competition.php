<?php
/*
Plugin Name: Competition
Description: Конкурс
*/
//wp_enqueue_script( 'competition', get_stylesheet_directory_uri() . '/js/competition.js', array( 'jquery' ), '1.0', true );
wp_enqueue_style( 'uji_countdown', plugins_url('css/uji-countdown.css', __FILE__) );
wp_enqueue_script('jquery.cookie', plugins_url('js/jquery.cookie.js' , __FILE__), array('jquery'), '1.72');
wp_enqueue_script('competition_script', plugins_url('js/competition.js',  __FILE__), array('jquery'), '1.72');



function competition_function($atts)
{
   ob_start(); 
   global $wpdb;
   static $allQuotes;    
     
   extract( shortcode_atts( array(
        'pair' => ''
    ), $atts ) );
   
   extract( shortcode_atts( array(
        'count' => ''
    ), $atts ) );
   
   extract( shortcode_atts( array(
        'quotes' => ''
    ), $atts ) );   
    if ($count) {
        require_once('functions/formatCount.php');
        $countPairs = array();
        $countParticipants = $wpdb->get_var("select count(*) from wp_competition_participants where pair = '$count'");	
        if (!$countParticipants) {
            $countParticipants = 0;
        }
	//$countParticipants = '423';
        $digits = formatCount($countParticipants);
        include 'design/count.php';
    } else if ($pair) {	
        switch($pair) {
            case 'USD/RUR':
                include 'forms/usd-rur.php';
                break;
            case 'EUR/USD':
                include 'forms/eur-usd.php';
                break;
	    case 'bitcoin':		
                include 'forms/bitcoin.php';
                break;
	    case 'GBP/USD':
                include 'forms/gbp-usd.php';
                break;
        }
    } else if ($quotes) {
	if ($quotes == 'bitcoin') {
	    require_once('get_quotes_function/json/get_quotes.php');
	    $pair = 'bitcoin';
	    $quotes = get_quotes();
		$price = $quotes['price'];
		$arrow = $quotes['arrow'];	    
	    include 'design/quotes/bitcoin.php';            		
	}
        else if ($quotes == 'GBP/USD') {
           require_once('get_quotes_function/gbp_usd/get_quotes.php'); 
           $quotes = get_quotes();
           include 'design/quotes/gbp_usd.php';
        }
	else if ($quotes == 'GBP/TEST') {
           require_once('get_quotes_function/gbp_usd_test/get_quotes.php'); 
           $quotes = get_quotes();
           include 'design/quotes/gbp_usd.php';
        }
        else if ($quotes == 'EUR/USD') {
           require_once('get_quotes_function/eur_usd/get_quotes.php'); 
           $quotes = get_quotes();
           include 'design/quotes.php';
        }
        else if (!$allQuotes) {
	    require_once('get_quotes_function/get_quotes.php');			
            $allQuotes = get_quotes(); 
	    $quotesPair = str_replace("/", "", $quotes);
            $pairBid = $allQuotes[$quotesPair]['bid'];
            $pairAsk = $allQuotes[$quotesPair]['ask'];
            $pairArrow = $allQuotes[$quotesPair]['arrow']; 
	    include 'design/quotes.php';          
        }                     
   }   
   $output = ob_get_clean(); return $output;  
}
add_shortcode('competition', 'competition_function');

function competition_participants_function($atts)
{
  ob_start();
  global $wpdb;
  
  require_once('functions/functions.php');
  //pair
  $pair = CheckUserData($_GET['pair']);
  $pairUrlFormat = $pair;
  $pair = pairDbFormat($pair); 
  if (empty($pair)) {
      extract( shortcode_atts( array(
        'pair' => ''
    ), $atts ) );
  }
  //page	
  $page = CheckUserData($_GET['pg']);
  if (empty($page)) {
     $page = 1; 
  }
  $query = "select * from wp_competition_participants where pair = '$pair' order by date desc";
  $participants = page_navigation($query,20,$page,$total);

  $pageNavigationMenu = page_navigation_menu($page, $total,get_permalink(),$pairUrlFormat);
  switch($pair) {
        case 'USD/RUR':
            include 'pages/usd-rur.php';
            break;
        case 'EUR/USD':
            include 'pages/eur-usd.php';
            break;
	case 'GBP/USD':
            include 'pages/gbp-usd.php';
            break;
	case 'bitcoin':	    
            include 'pages/bitcoin.php';
            break;
  }
  
  $output = ob_get_clean(); return $output;  
}
add_shortcode('competition_participants', 'competition_participants_function');

function competition_history_function($atts)
{
	ob_start();
	global $wpdb;
	
	 extract( shortcode_atts( array(
        'number' => ''
    ), $atts ) );
extract( shortcode_atts( array(
        'pair' => ''
    ), $atts ) );
	//$number = 7;	
        if (empty($number)) {
           $query = "select * from wp_competition_history where pair = '$pair' order by date desc"; 
        } else {
           $query = "select * from wp_competition_history where draw_number = $number and pair = '$pair' order by date desc"; 
        }	
	$participants = $wpdb->get_results($query);
	 switch($pair) {	       
	        case 'EUR/USD':
	            include 'design/history/eur-usd.php';
	            break;
		case 'GBP/USD':
	            include 'design/history/gbp-usd.php';
	            break;
		case 'bitcoin':
	            include 'design/history/btc-usd.php';
	            break;
 	 }

	//include 'design/history.php';

	$output = ob_get_clean(); return $output;
}
add_shortcode('competition_history', 'competition_history_function');

function participate()
{
    global $wpdb; 
    require_once('ajax/participate.php');
}
add_action('wp_ajax_participate', 'participate');
add_action('wp_ajax_nopriv_participate', 'participate');

include_once 'admin/Submenu.php';
include_once 'admin/Submenu_Page.php';
function competition_admin_settings() 
{
    global $wpdb;
    $pluginPath = plugin_dir_path( __FILE__);
    $paths = array();
    $paths['controllers'] = "$pluginPath/admin/controllers";
    $paths['views'] = "$pluginPath/admin/views";
    $plugin = new Submenu( new Submenu_Page($paths) );
    $plugin->init();
}
add_action('plugins_loaded', 'competition_admin_settings' );


