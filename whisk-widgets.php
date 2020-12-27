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
 * @author  Pavel Fedorov
 */
use Whisk\RecipeWidgets\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'WHISK_WIDGETS_VERSION', '1.0' );
define( 'WHISK_WIDGETS_PATH', __DIR__ );
define( 'WHISK_WIDGETS_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'WHISK_WIDGETS_FILE', __FILE__ );
define( 'WHISK_WIDGETS_SLUG', 'whisk-recipe-widgets' );

/**
 * Init plugin class on plugin load.
 */

static $plugin;

if ( ! isset( $plugin ) ) {
	require_once WHISK_WIDGETS_PATH . '/vendor/autoload.php';
	$plugin = new Main();
}

// eof;
