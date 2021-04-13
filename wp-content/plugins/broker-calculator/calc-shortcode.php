<?php 
add_action( 'save_post_calculator', 'my_calculator_update_shortcode', 10, 3 );
	function my_calculator_update_shortcode(  $post_ID, $post, $update ) {


		if ( wp_is_post_revision( $post_ID ) || get_post($post_ID)->post_status != 'publish' )
			return;
		if(get_post_type( $post ) != 'calculator')
			return;
		update_post_meta($post_ID, 'calculator_shortcode', '[broker_calculator id="'.$post_ID.'"]');
	}


	add_action('add_meta_boxes', 'calculator_add_custom_box');
	function calculator_add_custom_box(){
		$screens = array( 'calculator');
		add_meta_box( 'calculator_shortcode', 'Шорткод калькулятора', 'calculator_meta_box_callback', $screens );
	}


	function calculator_meta_box_callback( $post, $meta ){
		$screens = $meta['args'];
		$shortcode = get_post_meta( $post->ID, 'calculator_shortcode', true );
		if ($shortcode) {
			echo "<p>{$shortcode}</p>";
		}
	}

	function broker_calculator_func($atts) {
		$atts = shortcode_atts( array(
			'id' => 0,
		), $atts );
		set_query_var( 'calc_id', $atts['id'] );
		ob_start();
		require 'calc-template.php';
		return ob_get_clean(); 
	} 

	add_shortcode( 'broker_calculator', 'broker_calculator_func' );
