<?php
/**
 * Whisk Widgets
 *
 * Plugin Name: Whisk Recipe Widgets
 * Plugin URI: https://wordpress.org/plugins/whisk-recipe-widgets/
 * Description: Whisk Recipe widgets
 * Author: Pavel Fedorov
 * Author URI: https://www.kobzarev.com/
 * Requires at least: 5.0
 * Tested up to: 5.6
 * Version: 0.3.10
 * Stable tag: 0.3.10
 *
 * Text Domain: whisk-recipe-widgets
 * Domain Path: /languages/
 *
 * GitHub Plugin URI: https://github.com/mihdan/whisk-recipe-widgets
 *
 * @package whisk-recipe-widgets
 * @author  Mikhail Kobzarev
 */
use Whisk\RecipeWidgets\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'MIHDAN_MAILRU_PULSE_FEED_VERSION', '0.3.10' );
define( 'MIHDAN_MAILRU_PULSE_FEED_PATH', __DIR__ );
define( 'MIHDAN_MAILRU_PULSE_FEED_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'MIHDAN_MAILRU_PULSE_FEED_FILE', __FILE__ );
define( 'MIHDAN_MAILRU_PULSE_FEED_SLUG', 'whisk-recipe-widgets' );

/**
 * Init plugin class on plugin load.
 */

static $plugin;

if ( ! isset( $plugin ) ) {
	require_once MIHDAN_MAILRU_PULSE_FEED_PATH . '/vendor/autoload.php';
	$plugin = new Main();
}

// eof;
