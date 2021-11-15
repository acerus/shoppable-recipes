<?php
/**
 * @package shoppable-recipes
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'SHOPPABLE_RECIPES_review_dismissed' );
delete_option( 'save-recipe' );
delete_option( 'contacts' );
delete_option( 'SHOPPABLE_RECIPES_version' );
// eol.

