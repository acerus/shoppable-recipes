<?php
/**
 * @package whisk-recipe-widgets
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'WHISK_WIDGETS_review_dismissed' );
delete_option( 'shopping-list' );
delete_option( 'contacts' );
delete_option( 'WHISK_WIDGETS_version' );
// eol.

