<?php
/**
 * Shoppable Recipes
 *
 * Plugin Name: Shoppable Recipes
 * Plugin URI:
 * Description: Shopping list widget with Whisk.com integration
 * Author: Pavel Fedorov
 * Author URI: http://paulfedorov.blog/
 * Requires at least: 5.0
 * Tested up to: 5.6
 * Version: 1.0.4
 * Stable tag: 1.0.4
 *
 * Text Domain: shoppable-recipes
 * Domain Path: /languages/
 *
 * GitHub Plugin URI: https://github.com/acerus/shoppable-recipes
 *
 * @package shoppable-recipes
 * @author  Pavel Fedorov
 */
use PaulFedorov\RecipeWidgets\Main;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'SHOPPABLE_RECIPES_VERSION', '1.0.4' );
define( 'SHOPPABLE_RECIPES_PATH', __DIR__ );
define( 'SHOPPABLE_RECIPES_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SHOPPABLE_RECIPES_FILE', __FILE__ );
define( 'SHOPPABLE_RECIPES_SLUG', 'shoppable-recipes' );

/**
 * Init plugin class on plugin load.
 */

static $plugin;

if ( ! isset( $plugin ) ) {
	require_once SHOPPABLE_RECIPES_PATH . '/vendor/autoload.php';
	$plugin = new Main();
}

// eof;
