<?php
/**
 * @package shoppable-recipes
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'SHOPPABLE_RECIPES_review_dismissed' );
delete_option( 'shopping-list' );
delete_option( 'contacts' );
delete_option( 'SHOPPABLE_RECIPES_version' );
// eol.

