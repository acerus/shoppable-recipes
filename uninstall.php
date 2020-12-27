<?php
/**
 * @package whisk-recipe-widgets
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option( 'wptrt_notice_dismissed_whisk-recipe-widgets' );
delete_option( 'WHISK_WIDGETS_review_dismissed' );
delete_option( 'feed' );
delete_option( 'source' );
delete_option( 'widget' );
delete_option( 'contacts' );
delete_option( 'WHISK_WIDGETS_version' );
// eol.

