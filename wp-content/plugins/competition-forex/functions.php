<?php

//подключение скриптов
function scripts_competition_forex_include()
{
    global $post;

    if( has_shortcode( $post->post_content, 'competition-forex-registration') || has_shortcode( $post->post_content, 'competition_forex_participants_function') ) {
        wp_enqueue_style( 'style_competition_forex_css', plugins_url('css/style.css', __FILE__) );
        wp_enqueue_script('competition_competition_forex_script', plugins_url('js/competition.js',  __FILE__), array( 'jquery' ), '1.72', true);
        wp_enqueue_script( 'raphael_min', plugins_url('js/library/raphael-min.js', __FILE__) );
        wp_enqueue_script( 'min_graph', plugins_url('js/min-graph.js', __FILE__) ); 
    }
}

add_filter('wp_enqueue_scripts', 'scripts_competition_forex_include');
