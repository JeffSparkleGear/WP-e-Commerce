<?php
add_action( 'wpsc_hourly_cron_task', 'wpsc_clear_stock_claims' );
add_action( 'wpsc_hourly_cron_task', '_wpsc_clear_customer_meta' );

/**
 * wpsc_clear_stock_claims, clears the stock claims, runs using wp-cron and when editing purchase log statuses via the dashboard
 */
function wpsc_clear_stock_claims() {
	global $wpdb;

	$time = (float) get_option( 'wpsc_stock_keeping_time', 1 );
	$interval = get_option( 'wpsc_stock_keeping_interval', 'day' );

	// we need to convert into seconds because we're allowing decimal intervals like 1.5 days
	$convert = array(
		'hour' => 3600,
		'day'  => 86400,
		'week' => 604800,
	);

	$seconds = floor( $time * $convert[$interval] );

	$sql = $wpdb->prepare( "DELETE FROM " . WPSC_TABLE_CLAIMED_STOCK . " WHERE last_activity < UTC_TIMESTAMP() - INTERVAL %d SECOND", $seconds );
	$wpdb->query( $sql );
}

function _wpsc_clear_customer_meta() {
	global $wpdb;

	bling_log( __FUNCTION__ );
	require_once( ABSPATH . 'wp-admin/includes/user.php' );

	$now = time();

	// find all WPEC temporary users that are ready to delete, doing this as one query saves roundtrips to the database
	$sql = 'UPDATE ' . $wpdb->usermeta . '
		SET
			meta_key = "_wpsc_temporary_profile_to_delete"
		WHERE
			meta_key = "' .  _wpsc_get_customer_meta_key( 'temporary_profile' ) . '" AND (CAST(meta_value AS UNSIGNED) < ' . $now . ' )';

	$results = $wpdb->query( $sql );


	// get the list of all WPEC temporary users that are ready to delete
	$sql = "
		SELECT user_id
		FROM {$wpdb->usermeta}
		WHERE
			meta_key = '_wpsc_temporary_profile_to_delete'
	";

	$ids = $wpdb->get_col( $sql );

	// For each of the ids double check to be sure there isn't any important data associated with the temporary user.
	// If important data is found the user is no longer temporary.
	foreach ( $ids as $id ) {
		// for extra safety
		if ( ( wpsc_customer_purchase_count( $id ) == 0 ) && ( wpsc_customer_post_count( $id ) == 0 ) && ( wpsc_customer_comment_count( $id ) == 0 ) ) {
			bling_log( 'Deleting user ID ' . $id );
			wp_delete_user( $id );
			delete_user_meta( $id, '_wpsc_temporary_profile_to_delete' ); // just in case of orphaned meta
		} else {
			// user should not be temporary
			delete_user_meta( $id, '_wpsc_temporary_profile_to_delete' );
		}
	}
}

