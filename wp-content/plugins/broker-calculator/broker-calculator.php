<?php
/*
Plugin Name: Калькулятор
Description: Создание шорткода калькулятора
Version: 1.0.0
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

register_activation_hook( __FILE__, 'calc_plugin_activate' );
function calc_plugin_activate(){

    // Require parent plugin
    if ( ! is_plugin_active( 'advanced-custom-fields-pro-master/acf.php' ) and current_user_can( 'activate_plugins' ) ) {
        // Stop activation redirect and show error
        wp_die('Sorry, but this plugin requires the Advanced Custom Field Pro plugin to be installed and active. <br><a href="' . admin_url( 'plugins.php' ) . '">&laquo; Return to Plugins</a>');
    }
    

}

/* Calculator */
	function my_post_type_calculator() {
		register_post_type( 'calculator',
			array(
				'label'               => 'Калькулятор',
				'singular_label'      => 'Калькулятор',
				'_builtin'            => false,
				'exclude_from_search' => true, 
				'capability_type'     => 'post',
				'public'              => false,
				'show_ui'             => true,
				'show_in_nav_menus'   => false,
				'rewrite' => false,
				'query_var' => false, 
				'menu_icon' => 'dashicons-editor-kitchensink',
				'supports'  => array(
									'title',
									// 'custom-fields'
								)
			)
		);
	}
	add_action('init', 'my_post_type_calculator');

require_once dirname(__file__) . '/calc-fields.php';
require_once dirname(__file__) . '/calc-shortcode.php';
require_once dirname(__file__) . '/calc-enqueue.php';
