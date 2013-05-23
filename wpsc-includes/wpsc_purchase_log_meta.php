<?php
 /* 
 * NOTICE: 
 * This file was automatically created, strongly suggest that it not be edited directly.
<<<<<<< HEAD
 * See the code in the file wpsc_custom_meta_init.php at line 211 for more details.
=======
 * See the code in the file wpsc_custom_meta_init.php at line 213 for more details.
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 */
?>

<?php 

//
// purchase_log meta functions
//

/**
 * Add meta data field to a purchase_log.
 *
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $purchase_log_id purchase_log ID.
 * @param string $meta_key Metadata name.
 * @param mixed $meta_value Metadata value.
 * @param bool $unique Optional, default is false. Whether the same key should not be added.
 * @return bool False for failure. True for success.
 */
<<<<<<< HEAD
function add_purchase_log_meta( $purchase_log_id , $meta_key , $meta_value , $unique = false ) {
	return add_metadata( 'purchase_log' ,  $purchase_log_id, $meta_key , $meta_value, $unique );
=======
function add_purchase_log_meta($purchase_log_id, $meta_key, $meta_value, $unique = false) {
	return add_metadata('purchase_log', $purchase_log_id, $meta_key, $meta_value, $unique);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Remove metadata matching criteria from a purchase_log.
 *
 * You can match based on the key, or key and value. Removing based on key and
 * value, will keep from removing duplicate metadata with the same key. It also
 * allows removing all metadata matching key, if needed.
 
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $purchase_log_id purchase_log ID
 * @param string $meta_key Metadata name.
 * @param mixed $meta_value Optional. Metadata value.
 * @return bool False for failure. True for success.
 */
<<<<<<< HEAD
function delete_purchase_log_meta( $purchase_log_id , $meta_key , $meta_value = '' ) {
	return delete_metadata( 'purchase_log' ,  $purchase_log_id , $meta_key , $meta_value );
=======
function delete_purchase_log_meta($purchase_log_id, $meta_key, $meta_value = '') {
	return delete_metadata('purchase_log', $purchase_log_id, $meta_key, $meta_value);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Retrieve purchase_log meta field for a purchase_log.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
 * @link http://codex.wordpress.org/Function_Reference/get_purchase_log_meta
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $purchase_log_id purchase_log ID.
 * @param string $key Optional. The meta key to retrieve. By default, returns data for all keys.
 * @param bool $single Whether to return a single value.
 * @return mixed Will be an array if $single is false. Will be value of meta data field if $single
 *  is true.
 */
<<<<<<< HEAD
function get_purchase_log_meta( $purchase_log_id , $key = '' , $single = false ) {
	return get_metadata( 'purchase_log' , $purchase_log_id , $key, $single );
=======
function get_purchase_log_meta($purchase_log_id, $key = '', $single = false) {
	return get_metadata('purchase_log', $purchase_log_id, $key, $single);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 *  Determine if a meta key is set for a given purchase_log.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
 * @link http://codex.wordpress.org/Function_Reference/get_purchase_log_meta
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $purchase_log_id purchase_log ID.
 * @param string $key Optional. The meta key to retrieve. By default, returns data for all keys.
* @return boolean true of the key is set, false if not.
 *  is true.
 */
<<<<<<< HEAD
function purchase_log_meta_exists( $purchase_log_id , $meta_key ) {
	return metadata_exists( 'purchase_log' , $purchase_log_id , $meta_key );
}

=======
function purchase_log_meta_exists($purchase_log_id, $meta_key ) {
	return metadata_exists( 'purchase_log', $purchase_log_id, $meta_key );

}




>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
/**
 * Update purchase_log meta field based on purchase_log ID.
 *
 * Use the $prev_value parameter to differentiate between meta fields with the
 * same key and purchase_log ID.
 *
 * If the meta field for the purchase_log does not exist, it will be added.

 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $purchase_log_id $purchase_log ID.
 * @param string $meta_key Metadata key.
 * @param mixed $meta_value Metadata value.
 * @param mixed $prev_value Optional. Previous value to check before removing.
 * @return bool False on failure, true if success.
 */
<<<<<<< HEAD
function update_purchase_log_meta( $purchase_log_id , $meta_key , $meta_value , $prev_value = '' ) {
	return update_metadata( 'purchase_log' , $purchase_log_id , $meta_key , $meta_value , $prev_value );
=======
function update_purchase_log_meta($purchase_log_id, $meta_key, $meta_value, $prev_value = '') {
	return update_metadata('purchase_log', $purchase_log_id, $meta_key, $meta_value, $prev_value);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Delete everything from purchase_log meta matching meta key.
 * This meta data function mirrors a corresponding wordpress post meta function.
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param string $purchase_log_meta_key Key to search for when deleting.
 * @return bool Whether the purchase_log meta key was deleted from the database
 */
<<<<<<< HEAD
function delete_purchase_log_meta_by_key( $purchase_log_meta_key ) {
	return delete_metadata( 'purchase_log' , null , $purchase_log_meta_key , '' , true );
=======
function delete_purchase_log_meta_by_key($purchase_log_meta_key) {
	return delete_metadata( 'purchase_log', null, $purchase_log_meta_key, '', true );
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Retrieve purchase_log meta fields, based on purchase_log ID.
 *
 * The purchase_log meta fields are retrieved from the cache where possible,
 * so the function is optimized to be called more than once.
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
 *
 * @param int $purchase_log_id purchase_log ID.
 * @return array
 */
function get_purchase_log_custom( $purchase_log_id = 0 ) {
	$purchase_log_id = absint( $purchase_log_id );
<<<<<<< HEAD
=======
	if ( ! $purchase_log_id )
		$purchase_log_id = get_the_ID();

>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
	return get_purchase_log_meta( $purchase_log_id );
}

/**
 * Retrieve meta field names for a purchase_log.
 *
 * If there are no meta fields, then nothing (null) will be returned.
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
 *
 * @param int $purchase_log_id purchase_log ID
 * @return array|null Either array of the keys, or null if keys could not be retrieved.
 */
function get_purchase_log_custom_keys( $purchase_log_id = 0 ) {
	$custom = get_purchase_log_custom( $purchase_log_id );

<<<<<<< HEAD
	if ( !is_array( $custom ) )
		return;

	if ( $keys = array_keys( $custom ) )
=======
	if ( !is_array($custom) )
		return;

	if ( $keys = array_keys($custom) )
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
		return $keys;
}

/**
 * Retrieve values for a custom purchase_log field.
 *
 * The parameters must not be considered optional. All of the purchase_log meta fields
 * will be retrieved and only the meta field key values returned.
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
 *
 * @param string $key Meta field key.
 * @param int $purchase_log_id purchase_log ID
 * @return array Meta field values.
 */
function get_purchase_log_custom_values( $key = '', $purchase_log_id = 0 ) {
	if ( !$key )
		return null;

<<<<<<< HEAD
	$custom = get_purchase_log_custom( $purchase_log_id );

	return isset( $custom[$key] ) ? $custom[$key] : null;
=======
	$custom = get_purchase_log_custom($purchase_log_id);

	return isset($custom[$key]) ? $custom[$key] : null;
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}



/**
 * Get meta timestamp by meta ID
 *
 * @since 3.9.0
 *
 * @param string $meta_type Type of object metadata is for (e.g., variation. cart, etc)
 	* @param int $meta_id ID for a specific meta row
 * @return object Meta object or false.
 */
function get_purchase_log_meta_timestamp( $purchase_log_id, $meta_key  ) {
	return wpsc_get_metadata_timestamp( 'purchase_log', $purchase_log_id, $meta_key );
}



