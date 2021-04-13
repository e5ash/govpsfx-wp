<?php
/**
 * Factory Adverts
 *
 * @author        Alexander Vitkalov <nechin.va@gmail.com>
 * @since         1.0.0
 *
 * @package       factory-ad-inserter
 * @copyright (c) 2019, Webcraftic Ltd
 *
 * @version       1.2.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// module provides function only for the admin area
if ( ! is_admin() ) {
	return;
}

if ( defined( 'FACTORY_ADVERTS_000_LOADED' ) ) {
	return;
}

define( 'FACTORY_ADVERTS_000_LOADED', true );

/**
 * Rest request url.
 *
 * Define rest request url for rest request to remote server.
 *
 * @since 1.2.1
 * @var string
 * @uses  do_rest_request()
 */
if(!defined('WBCR_ADINSERTER_REST_URL')) {
	define( 'WBCR_ADINSERTER_REST_URL', 'https://api.cm-wp.com' );
}

define( 'FACTORY_ADVERTS_000_DIR', dirname( __FILE__ ) );
define( 'FACTORY_ADVERTS_000_URL', plugins_url( null, __FILE__ ) );

require_once( FACTORY_ADVERTS_000_DIR . '/includes/class-adverts-rest-request.php' );
require_once( FACTORY_ADVERTS_000_DIR . '/includes/class-adverts-base.php' );
