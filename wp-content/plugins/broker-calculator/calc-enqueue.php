<?php 
add_action( 'wp_enqueue_scripts', 'calc_custom_scripts' );

function calc_custom_scripts() {
	global $post;
	/**
	 * How to enqueue script?
	 *
	 * @link http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 */
	if( is_singular( 'rebate_service' ) && has_shortcode( $post->post_content, 'broker_calculator')) {
		wp_enqueue_script( 'datatables', plugin_dir_url(__FILE__) . 'assets/libs/datatables/datatables.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'underscore', plugin_dir_url(__FILE__) . 'assets/libs/underscore.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'scrollbar', plugin_dir_url(__FILE__) . 'assets/libs/scrollbar/scrollbar.min.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'calc-script', plugin_dir_url(__FILE__) . 'assets/plugin-script.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_style( 'datatables', plugin_dir_url(__FILE__) . 'assets/libs/datatables/datatables.css' );
		wp_enqueue_style( 'scrollbar', plugin_dir_url(__FILE__) . 'assets/libs/scrollbar/scrollbar.min.css' );
		wp_enqueue_style( 'calc-style', plugin_dir_url(__FILE__) . 'assets/plugin-style.css' );
	}
}
?>