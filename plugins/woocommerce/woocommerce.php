<?php
/**
 * Plugin Name: WooCommerce
 * Plugin URI: https://woocommerce.com/
 * Description: An eCommerce toolkit that helps you sell anything. Beautifully.
 * Version: 7.9.0-dev
 * Author: Automattic
 * Author URI: https://woocommerce.com
 * Text Domain: woocommerce
 * Domain Path: /i18n/languages/
 * Requires at least: 6.1
 * Requires PHP: 7.3
 *
 * @package WooCommerce
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WC_PLUGIN_FILE' ) ) {
	define( 'WC_PLUGIN_FILE', __FILE__ );
}

// Load core packages and the autoloader.
require __DIR__ . '/src/Autoloader.php';
require __DIR__ . '/src/Packages.php';

if ( ! \Automattic\WooCommerce\Autoloader::init() ) {
	return;
}
\Automattic\WooCommerce\Packages::init();

// Include the main WooCommerce class.
if ( ! class_exists( 'WooCommerce', false ) ) {
	include_once dirname( WC_PLUGIN_FILE ) . '/includes/class-woocommerce.php';
}

// Initialize dependency injection.
$GLOBALS['wc_container'] = new Automattic\WooCommerce\Container();

/**
 * Returns the main instance of WC.
 *
 * @since  2.1
 * @return WooCommerce
 */
function WC() { // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	return WooCommerce::instance();
}

/**
 * Returns the WooCommerce object container.
 * Code in the `includes` directory should use the container to get instances of classes in the `src` directory.
 *
 * @since  4.4.0
 * @return \Automattic\WooCommerce\Container The WooCommerce object container.
 */
function wc_get_container() {
	return $GLOBALS['wc_container'];
}

// Global for backwards compatibility.
$GLOBALS['woocommerce'] = WC();

Automattic\WooCommerce\Internal\RestApi\Infrastructure\RestApiEngine::initialize();

add_filter('wc_rest_api_v4_additional_endpoints', function($endpoints) {
	$endpoints[] = [
		'class_name' => 'RestApiCalculator',
		'endpoints' => [
			[
				'verbs' => 'GET',
				'route' => '/calculator/add',
				'method_name' => 'add',
				'allows_unauthenticated' => true
			]
		]
	];
	return $endpoints;
}, 10, 1);

use Automattic\WooCommerce\Internal\RestApi\Infrastructure\ResponseException;

class RestApiCalculator {
	public static function add($request,  $user) {
		$num1 = self::get_argument($request, 'num1');
		$num2 = self::get_argument($request, 'num2');
		return $num1 + $num2;
	}

	private static function get_argument($request, $name) {
		$arg = $request->get_param($name) ?? null;
		if($arg === null) {
			throw ResponseException::for_wp_error(400, 'missing_Argument', "$name is missing");
		}
		if(!is_numeric($arg)) {
			throw ResponseException::for_wp_error(400, 'missing_Argument', "$name is not a number");
		}

		return $arg;
	}
}

