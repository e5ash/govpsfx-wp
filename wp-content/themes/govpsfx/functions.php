<?php
/**
 * govpsfx functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package govpsfx
 */

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'rev_thumb', 97, 97, true );
	add_image_size( 'bonus_thumb', 540, 300, true );
	add_image_size( 'advisers_thumb', 178, 233, true );
	add_image_size( 'brokers_thumb', 85, 85, false );
	add_image_size( 'brokers_obzor_thumb', 198, 79, false );
	add_image_size( 'news_thumb_medium', 620, 325, true );
	add_image_size( 'news_thumb_small', 460, 344, true );
	add_image_size( 'banner_thumb', 468, 60, true );
}

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'govpsfx_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function govpsfx_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on govpsfx, use a find and replace
		 * to change 'govpsfx' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'govpsfx', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'panel' => 'В панели',
				'nav-1' => 'Навигация 1',
				'nav-2' => 'Навигация 2',
				'nav-3' => 'Навигация 3',
				'footer' => 'В подвале',
				'sidebar' => 'В боковой панели',
				'contest' => 'В конкурсах',
				'vps' => 'В описании VPS',
			)
		);

	}
endif;
add_action( 'after_setup_theme', 'govpsfx_setup' );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Контакты',
		'menu_title'	=> 'Контакты',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}



function TEMP(){
	return get_template_directory_uri().'/static/source/dev/';
}



function phone($phone) {
	$ph = preg_replace('/[^\d+]/', '', $phone);
	return $ph;
}


// Миниатюры записей
if(1){
	add_action('init', 'add_post_thumbs_in_post_list_table', 20 );
	function add_post_thumbs_in_post_list_table(){
		// проверим какие записи поддерживают миниатюры
		$supports = get_theme_support('post-thumbnails');

		// $ptype_names = array('post','page'); // указывает типы для которых нужна колонка отдельно

		// Определяем типы записей автоматически
		if( ! isset($ptype_names) ){
			if( $supports === true ){
				$ptype_names = get_post_types(array( 'public'=>true ), 'names');
				$ptype_names = array_diff( $ptype_names, array('attachment') );
			}
			// для отдельных типов записей
			elseif( is_array($supports) ){
				$ptype_names = $supports[0];
			}
		}

		// добавляем фильтры для всех найденных типов записей
		foreach( $ptype_names as $ptype ){
			add_filter( "manage_{$ptype}_posts_columns", 'add_thumb_column' );
			add_action( "manage_{$ptype}_posts_custom_column", 'add_thumb_value', 10, 2 );
		}
	}

	// добавим колонку
	function add_thumb_column( $columns ){
		// подправим ширину колонки через css
		add_action('admin_notices', function(){
			echo '
			<style>
				.column-thumbnail{ width:80px; text-align:center; }
			</style>';
		});

		$num = 1; // после какой по счету колонки вставлять новые

		$new_columns = array( 'thumbnail' => __('Thumbnail') );

		return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
	}

	// заполним колонку
	function add_thumb_value( $colname, $post_id ){
		if( 'thumbnail' == $colname ){
			$width  = $height = 45;

			// миниатюра
			if( $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true ) ){
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			// из галереи...
			elseif( $attachments = get_children( array(
				'post_parent'    => $post_id,
				'post_mime_type' => 'image',
				'post_type'      => 'attachment',
				'numberposts'    => 1,
				'order'          => 'DESC',
			) ) ){
				$attach = array_shift( $attachments );
				$thumb = wp_get_attachment_image( $attach->ID, array($width, $height), true );
			}

			echo empty($thumb) ? ' ' : $thumb;
		}
	}
}


// shortcodes
add_shortcode( 'dropdown', 'dropdown_func' );
function dropdown_func( $atts, $content ) {

	$rg = (object) shortcode_atts( [
		'title' => null
	], $atts );

	$content = strip_tags($content, '<ul><li>');

	$html = '<blockquote class="blockquote tog --show">
						<div class="blockquote__title tog-head">'.$rg->title.'</div>
						<div class="blockquote__content tog-body">'.$content.'</div>
					</blockquote>';
	 return $html;
}


add_shortcode( 'dropdown-text', 'dropdown_text_func' );
function dropdown_text_func( $atts, $content ) {

	$rg = (object) shortcode_atts( [
		'title' => null,
		'btn' => false,
	], $atts );

	$content = strip_tags($content, '<ul><li><img><a><p>');
	if ($rg->btn) {
		$modal_btn = '<a data-fancybox data-src="#write_us" href="#" class="btn-2 article__btn-2 article__btn-2_margin-1 send-me-btn">
							<p class="btn-2-text">написать письмо</p>
						</a>';
	} else {
		$modal_btn = '';
	}

	$html = '<blockquote class="blockquote tog --show">
						<div class="blockquote__title tog-head">'.$rg->title.'</div>
						<div class="blockquote__content tog-body">'.$content.'</div>
					</blockquote>';

	return $html;
}


add_shortcode( 'dropdown-numbering', 'dropdown_numbering_func' );
function dropdown_numbering_func( $atts, $content ) {

	$rg = (object) shortcode_atts( [
		'title' => null,
		'description' => null,
	], $atts );

	$content = strip_tags($content, '<li><img>');
	$arr_content = explode('</li>', $content);
	array_pop($arr_content);

	$i = 1;
	foreach ($arr_content as $value) {
		$content_html .= '<div class="article__block-item">
							<div class="article__block-item-hd">'.$i.'/</div>
							<div class="article__block-item-text">'.strip_tags($value, '<img>').'</div>
						</div>';
		$i++;
	}

	$html = '<div class="article__block article__block_margin-4 article__block_padding-1">
						<div class="article__block-nav">
							<p class="article__block-nav-text">'.$rg->title.'</p>
							<img src="'.get_template_directory_uri().'/img/article__block-nav-img.svg" alt="article__block-nav-img" class="article__block-nav-img">
							<img src="'.get_template_directory_uri().'/img/article__block-nav-img_plus.svg" alt="article__block-nav-img" class="article__block-nav-img_plus">
						</div>
						'.$content_html.'
						<p>'.$rg->description.'</p>
					</div>';
	 return $html;
}




add_shortcode( 'article-blocks', 'article_blocks_func' );
function article_blocks_func( $atts, $content ) {

	$rg = (object) shortcode_atts( [
		'title' => null,
	], $atts );

	$content = strip_tags($content, '<a>, <li>');
	$arr_content = explode('</li>', $content);
	array_pop($arr_content);

	$url = get_template_directory_uri();



	$i = 1;
	foreach ($arr_content as $value) {
		$content_html .= '<div class="steps__item bg-wrap">
							<div class="steps__link">'.strip_tags($value, '<a>').'</div>
							<div class="steps__count">0'.$i.'</div>
						</div>';
		$i++;
	}

	$html = '<div class="steps">
						<div class="steps__list row">
							'.$content_html.'
						</div>
					</div>';

	 return $html;
}



add_shortcode( 'rule-blocks', 'rule_blocks_func' );
function rule_blocks_func( $atts, $content ) {

	$rg = (object) shortcode_atts( [
		'title' => null
	], $atts );


	$content = strip_tags($content, '<li><a>');
	$arr_content = explode('</li>', $content);
	array_pop($arr_content);

	$i = 1;
	foreach ($arr_content as $value) {
	$content_html .= '<div class="get-free__item bg-wrap">
							<div class="get-free__text">'.strip_tags($value, '<a>').'</div>
							<div class="get-free__count">#0'.$i.'</div>
						</div>';
	$i++;
	}

	$html = '<div class="get-free">
						<div class="get-free__list row">
							'.$content_html.'
						</div>
					</div>';
	 return $html;
}


// CustomTypes
function cptui_register_my_cpts() {

	/**
	 * Post Type: Брокеры.
	 */

	$labels = [
		"name" => __( "Брокеры", "custom-post-type-ui" ),
		"singular_name" => __( "Брокер", "custom-post-type-ui" ),
		"menu_name" => __( "Брокеры", "custom-post-type-ui" ),
		"all_items" => __( "Брокеры", "custom-post-type-ui" ),
		"add_new" => __( "Добавить брокера", "custom-post-type-ui" ),
		"add_new_item" => __( "Добавить брокера", "custom-post-type-ui" ),
		"edit_item" => __( "Редактировать брокера", "custom-post-type-ui" ),
		"new_item" => __( "Новый  брокер", "custom-post-type-ui" ),
		"view_item" => __( "Брокер", "custom-post-type-ui" ),
		"view_items" => __( "Брокеры", "custom-post-type-ui" ),
		"search_items" => __( "Поиск брокера", "custom-post-type-ui" ),
		"not_found" => __( "Брокер не найден", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "Не найдены в корзине", "custom-post-type-ui" ),
		"parent" => __( "Parent Брокер:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Брокер", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Брокер", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Брокер", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Брокер", "custom-post-type-ui" ),
		"archives" => __( "Брокер archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Брокер", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Брокер", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Брокеры list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Брокеры list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Брокеры list", "custom-post-type-ui" ),
		"attributes" => __( "Брокеры attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Брокер", "custom-post-type-ui" ),
		"item_published" => __( "Брокер published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Брокер published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Брокер reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Брокер scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Брокер updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Брокер:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Брокеры", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "brokers", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-businessperson",
		"supports" => [ "title", "editor", "thumbnail", "excerpt", "trackbacks", "custom-fields", "comments", "revisions", "author", "page-attributes", "post-formats" ],
	];

	register_post_type( "brokers", $args );

	/**
	 * Post Type: Тарифы.
	 */

	$labels = [
		"name" => __( "Тарифы", "custom-post-type-ui" ),
		"singular_name" => __( "Тариф", "custom-post-type-ui" ),
		"menu_name" => __( "Тарифы", "custom-post-type-ui" ),
		"all_items" => __( "All Тарифы", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Тариф", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Тариф", "custom-post-type-ui" ),
		"new_item" => __( "New Тариф", "custom-post-type-ui" ),
		"view_item" => __( "View Тариф", "custom-post-type-ui" ),
		"view_items" => __( "View Тарифы", "custom-post-type-ui" ),
		"search_items" => __( "Search Тарифы", "custom-post-type-ui" ),
		"not_found" => __( "No Тарифы found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Тарифы found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Тариф:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Тариф", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Тариф", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Тариф", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Тариф", "custom-post-type-ui" ),
		"archives" => __( "Тариф archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Тариф", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Тариф", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Тарифы list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Тарифы list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Тарифы list", "custom-post-type-ui" ),
		"attributes" => __( "Тарифы attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Тариф", "custom-post-type-ui" ),
		"item_published" => __( "Тариф published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Тариф published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Тариф reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Тариф scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Тариф updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Тариф:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Тарифы", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "vps", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-image-filter",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "vps", $args );

	/**
	 * Post Type: Бонусы.
	 */

	$labels = [
		"name" => __( "Бонусы", "custom-post-type-ui" ),
		"singular_name" => __( "Бонус", "custom-post-type-ui" ),
		"menu_name" => __( "Бонусы", "custom-post-type-ui" ),
		"all_items" => __( "All Бонусы", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Бонус", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Бонус", "custom-post-type-ui" ),
		"new_item" => __( "New Бонус", "custom-post-type-ui" ),
		"view_item" => __( "View Бонус", "custom-post-type-ui" ),
		"view_items" => __( "View Бонусы", "custom-post-type-ui" ),
		"search_items" => __( "Search Бонусы", "custom-post-type-ui" ),
		"not_found" => __( "No Бонусы found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Бонусы found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Бонус:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Бонус", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Бонус", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Бонус", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Бонус", "custom-post-type-ui" ),
		"archives" => __( "Бонус archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Бонус", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Бонус", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Бонусы list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Бонусы list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Бонусы list", "custom-post-type-ui" ),
		"attributes" => __( "Бонусы attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Бонус", "custom-post-type-ui" ),
		"item_published" => __( "Бонус published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Бонус published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Бонус reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Бонус scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Бонус updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Бонус:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Бонусы", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "bonuses", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-products",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "bonuses", $args );

	/**
	 * Post Type: Глоссарий терминов.
	 */

	$labels = [
		"name" => __( "Глоссарий терминов", "custom-post-type-ui" ),
		"singular_name" => __( "Глоссарий терминов", "custom-post-type-ui" ),
		"menu_name" => __( "Глоссарий терминов", "custom-post-type-ui" ),
		"all_items" => __( "All Глоссарий терминов", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Глоссарий терминов", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Глоссарий терминов", "custom-post-type-ui" ),
		"new_item" => __( "New Глоссарий терминов", "custom-post-type-ui" ),
		"view_item" => __( "View Глоссарий терминов", "custom-post-type-ui" ),
		"view_items" => __( "View Глоссарий терминов", "custom-post-type-ui" ),
		"search_items" => __( "Search Глоссарий терминов", "custom-post-type-ui" ),
		"not_found" => __( "No Глоссарий терминов found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Глоссарий терминов found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Глоссарий терминов:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Глоссарий терминов", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Глоссарий терминов", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Глоссарий терминов", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Глоссарий терминов", "custom-post-type-ui" ),
		"archives" => __( "Глоссарий терминов archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Глоссарий терминов", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Глоссарий терминов", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Глоссарий терминов list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Глоссарий терминов list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Глоссарий терминов list", "custom-post-type-ui" ),
		"attributes" => __( "Глоссарий терминов attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Глоссарий терминов", "custom-post-type-ui" ),
		"item_published" => __( "Глоссарий терминов published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Глоссарий терминов published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Глоссарий терминов reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Глоссарий терминов scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Глоссарий терминов updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Глоссарий терминов:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Глоссарий терминов", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "forex-glossary", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-welcome-view-site",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "glossary", $args );

	/**
	 * Post Type: Вопросы.
	 */

	$labels = [
		"name" => __( "Вопросы", "custom-post-type-ui" ),
		"singular_name" => __( "Вопрос", "custom-post-type-ui" ),
		"menu_name" => __( "Вопросы", "custom-post-type-ui" ),
		"all_items" => __( "Вопросы", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Вопрос", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Вопрос", "custom-post-type-ui" ),
		"new_item" => __( "New Вопрос", "custom-post-type-ui" ),
		"view_item" => __( "View Вопрос", "custom-post-type-ui" ),
		"view_items" => __( "View Вопросы", "custom-post-type-ui" ),
		"search_items" => __( "Search Вопросы", "custom-post-type-ui" ),
		"not_found" => __( "No Вопросы found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Вопросы found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Вопрос:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Вопрос", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Вопрос", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Вопрос", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Вопрос", "custom-post-type-ui" ),
		"archives" => __( "Вопрос archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Вопрос", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Вопрос", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Вопросы list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Вопросы list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Вопросы list", "custom-post-type-ui" ),
		"attributes" => __( "Вопросы attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Вопрос", "custom-post-type-ui" ),
		"item_published" => __( "Вопрос published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Вопрос published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Вопрос reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Вопрос scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Вопрос updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Вопрос:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Вопросы", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "faq", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-editor-help",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "faq", $args );

	/**
	 * Post Type: Отзывы.
	 */

	$labels = [
		"name" => __( "Отзывы", "custom-post-type-ui" ),
		"singular_name" => __( "Отзыв", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Отзывы", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "testimonial", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-format-quote",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "testimonial", $args );

	/**
	 * Post Type: Форекс советники.
	 */

	$labels = [
		"name" => __( "Форекс советники", "custom-post-type-ui" ),
		"singular_name" => __( "Советник", "custom-post-type-ui" ),
		"menu_name" => __( "Форекс советники", "custom-post-type-ui" ),
		"all_items" => __( "All Форекс советники", "custom-post-type-ui" ),
		"add_new" => __( "Add new", "custom-post-type-ui" ),
		"add_new_item" => __( "Add new Форекс советники", "custom-post-type-ui" ),
		"edit_item" => __( "Edit Форекс советники", "custom-post-type-ui" ),
		"new_item" => __( "New Форекс советники", "custom-post-type-ui" ),
		"view_item" => __( "View Форекс советники", "custom-post-type-ui" ),
		"view_items" => __( "View Форекс советники", "custom-post-type-ui" ),
		"search_items" => __( "Search Форекс советники", "custom-post-type-ui" ),
		"not_found" => __( "No Форекс советники found", "custom-post-type-ui" ),
		"not_found_in_trash" => __( "No Форекс советники found in trash", "custom-post-type-ui" ),
		"parent" => __( "Parent Форекс советники:", "custom-post-type-ui" ),
		"featured_image" => __( "Featured image for this Форекс советники", "custom-post-type-ui" ),
		"set_featured_image" => __( "Set featured image for this Форекс советники", "custom-post-type-ui" ),
		"remove_featured_image" => __( "Remove featured image for this Форекс советники", "custom-post-type-ui" ),
		"use_featured_image" => __( "Use as featured image for this Форекс советники", "custom-post-type-ui" ),
		"archives" => __( "Форекс советники archives", "custom-post-type-ui" ),
		"insert_into_item" => __( "Insert into Форекс советники", "custom-post-type-ui" ),
		"uploaded_to_this_item" => __( "Upload to this Форекс советники", "custom-post-type-ui" ),
		"filter_items_list" => __( "Filter Форекс советники list", "custom-post-type-ui" ),
		"items_list_navigation" => __( "Форекс советники list navigation", "custom-post-type-ui" ),
		"items_list" => __( "Форекс советники list", "custom-post-type-ui" ),
		"attributes" => __( "Форекс советники attributes", "custom-post-type-ui" ),
		"name_admin_bar" => __( "Форекс советники", "custom-post-type-ui" ),
		"item_published" => __( "Форекс советники published", "custom-post-type-ui" ),
		"item_published_privately" => __( "Форекс советники published privately.", "custom-post-type-ui" ),
		"item_reverted_to_draft" => __( "Форекс советники reverted to draft.", "custom-post-type-ui" ),
		"item_scheduled" => __( "Форекс советники scheduled", "custom-post-type-ui" ),
		"item_updated" => __( "Форекс советники updated.", "custom-post-type-ui" ),
		"parent_item_colon" => __( "Parent Форекс советники:", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Форекс советники", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "experts-forex", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-businessperson",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "advisers", $args );

	/**
	 * Post Type: Калькулятор.
	 */

	$labels = [
		"name" => __( "Калькулятор", "custom-post-type-ui" ),
		"singular_name" => __( "Калькулятор", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Калькулятор", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "calculator", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-editor-kitchensink",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "calculator", $args );

	/**
	 * Post Type: Рибейт сервис.
	 */

	$labels = [
		"name" => __( "Рибейт сервис", "custom-post-type-ui" ),
		"singular_name" => __( "Рибейт сервис", "custom-post-type-ui" ),
	];

	$args = [
		"label" => __( "Рибейт сервис", "custom-post-type-ui" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "rebate-service", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-grid-view",
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "rebate_service", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function broker_trading_terminal($id, $tax) {
	$trading_terminal = get_the_terms($id, $tax);

	$trading_terminal_arr = [];
	if ($trading_terminal) {
		foreach ($trading_terminal as $term) {
			$trading_terminal_arr[] = $term->name;
		}
	}

	return implode(', ', $trading_terminal_arr);
}


function children_pages($page_id) {
	$pages = get_children([
		'post_parent' => $page_id,
		'post_type'   => 'page',
		'numberposts' => -1,
		'post_status' => 'publish',
		'order'=> 'ASC',
	]);

	return $pages;
}

function read_following_article($parent_post, $post_id) {
	$posts = children_pages($parent_post);

	$posts_arr = [];
	foreach ($posts as $post) {
		$posts_arr[] = [
			'id' => $post->ID,
			'title' => $post->post_title,
			'href' => get_the_permalink($post->ID),
			'date' => get_the_date('j.m.Y', $post),
			'active' => ($post->ID == $post_id ? true : false),
		];
	}

	$current_key = array_search($post_id, array_column($posts_arr, 'id'));
	$next_key = $current_key + 1;

	return $posts_arr[$next_key];
}


function wph_cut_by_words($maxlen, $text) {
	$len = (mb_strlen($text) > $maxlen)? mb_strripos(mb_substr($text, 0, $maxlen), ' ') : $maxlen;
	$cutStr = mb_substr($text, 0, $len);
	$temp = (mb_strlen($text) > $maxlen)? $cutStr. '...' : $cutStr;
	return $temp;
}


function sidebar_subscribe() {
	$name = $_POST["name"];
	$email = $_POST["email"];
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	 echo '{"status": "error","message":"Ошибка ввода email, пожайлуста проверьте!"}';
	 die();
 }
 $ip = $_SERVER['REMOTE_ADDR'];
	//параметры
 $params = array(
		'email_address' => $email, //переданный через форму email
		'ip_address' => $ip
	);
	// преобразуем массив в URL-кодированную строку
 $vars = http_build_query($params);
	// создаем параметры контекста
 $options = array(
	'http' => array(
			'method'  => 'POST',  // метод передачи данных
			'header'  => 'Content-type: application/x-www-form-urlencoded',  // заголовок
			'content' => $vars,  // переменные
		)
); 
	$context  = stream_context_create($options);  // создадим контекст потока
	$result = file_get_contents('https://admin.govpsfx.com/subscribe.php', false, $context); //отправляем запрос
	if ($result != 200){
		if ($result == 400){
			echo '{"status": "error","message":"Ошибка ввода данных, пожайлуста проверьте!"}';
			die();
		}
		echo '{"status": "error","message":"Ошибка подписки, пожайлуста попробуйте позже!"}';
		die();
	}
	echo '{"status": "ok","message":"Спасибо за подписку!"}';
	die();
}
add_action('wp_ajax_subscribeaction', 'sidebar_subscribe');
add_action('wp_ajax_nopriv_subscribeaction', 'sidebar_subscribe');
function partner_init() {
	global $wpdb;
		//Partner cookies
		if (!empty($_GET['ib']) && empty($_COOKIE["govpsfx_partner"])) {
				$partner_id = (int) $_GET['ib'];
		setcookie(
						'govpsfx_partner',
						json_encode(['partner_id' => $partner_id, 'installed_at' => time()]),
						strtotime("+1 year"),
						'/',
						"govpsfx.com",
						null,
						true
				);	 		 
		$wpdb->insert(
			'partner',
			array('partner_id' => $partner_id),
			array('%d', '%d' )
		);
		}
}
add_action("init", "partner_init");

function utm_init() {
	global $wpdb;
	//utm check
	if (!empty($_GET['utm_source']) || !empty($_GET['utm_medium']) || !empty($_GET['utm_campaign'] )) {
		$uri = esc_sql($_SERVER['REQUEST_URI']);
		$currenturl = get_site_url() . $_SERVER['REQUEST_URI'];
		setcookie(
						'utm_client',
						$currenturl,
						strtotime("+1 year"),
						'/',
						"govpsfx.com",
						null,
						true
				);
	}
}
add_action("init", "utm_init");


function true_load_posts(){
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';
 
	// обычно лучше использовать WP_Query, но не здесь
	query_posts( $args );
	// если посты есть
	if( have_posts() ) :
 
		// запускаем цикл
		while( have_posts() ): the_post();
 
			get_template_part( 'parts/news-item-sm', get_post_format() );
 
		endwhile;
 
	endif;
	die();
}
 
 
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');


function glossary_search($arr, $word) {
	$glossary = [];
	foreach ($arr as $k => $glos) {
		if( get_first_letter($glos->post_title) == $word ) {
			$glossary[$glos->ID] = [
				'id' => $glos->ID,
				'post_title' => $glos->post_title,
				'post_content' => $glos->post_content,
				'eng_name' => get_field('english_name', $glos->ID),
				'href' => get_the_permalink($glos->ID),
			];
		}
	}

	return $glossary;
}

function page_count($count_posts, $offset, $numberposts) {
	$count = $count_posts - ($offset + $numberposts);
	return $count < 0 ? 0 : $count;
}
function get_first_letter( $str ){
	return mb_substr($str, 0, 1, 'utf-8');
}

function isPSI(){
	return strpos($_SERVER['HTTP_USER_AGENT'],'Chrome-Lighthouse');
}

function display_content_banner($content)
{
	if ( is_single() && in_category('2') ) {
		$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
		$dom = new DOMDocument();
		@$dom->loadHTML($content);

		foreach ($dom->getElementsByTagName('h1') as $node) {

			$testNode = $dom->createElement('a');
			$testNode->setAttribute('href', 'https://alpari.forex/ru/trading/trading_terms/?partner_id=1227144');
			$testNode->setAttribute('target', '_blank');
			$testNode->setAttribute('class', 'fun-link');
			$imgnode = $dom->createElement('img');
			$imgnode->setAttribute('src', 'https://govpsfx.com/banners/brokers/banner-news-alpari.jpeg');
			$testNode->appendChild($imgnode);

			$node->parentNode->insertBefore($testNode, $node->nextSibling);

		}

		$content = preg_replace('/^<!DOCTYPE.+?>/', '', str_replace( array('<html>', '</html>', '<body>', '</body>'), array('', '', '', ''), $dom->saveHTML()));

	}

	return $content;
}

add_filter('the_content', 'display_content_banner');


function langLink() {
	$domain   = get_field('lang_link', 'option');
	$linkPage = get_field('lang_link', 'option').$_SERVER['REQUEST_URI'];
	$urlHeaders = @get_headers($linkPage);
	if(strpos($urlHeaders[0], '200')) {
		return $linkPage;
	} else {
		return $domain;
	}
}