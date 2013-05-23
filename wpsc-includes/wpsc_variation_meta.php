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
// variation meta functions
//

/**
 * Add meta data field to a variation.
 *
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $variation_id variation ID.
 * @param string $meta_key Metadata name.
 * @param mixed $meta_value Metadata value.
 * @param bool $unique Optional, default is false. Whether the same key should not be added.
 * @return bool False for failure. True for success.
 */
<<<<<<< HEAD
function add_variation_meta( $variation_id , $meta_key , $meta_value , $unique = false ) {
	return add_metadata( 'variation' ,  $variation_id, $meta_key , $meta_value, $unique );
=======
function add_variation_meta($variation_id, $meta_key, $meta_value, $unique = false) {
	return add_metadata('variation', $variation_id, $meta_key, $meta_value, $unique);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Remove metadata matching criteria from a variation.
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
 * @param int $variation_id variation ID
 * @param string $meta_key Metadata name.
 * @param mixed $meta_value Optional. Metadata value.
 * @return bool False for failure. True for success.
 */
<<<<<<< HEAD
function delete_variation_meta( $variation_id , $meta_key , $meta_value = '' ) {
	return delete_metadata( 'variation' ,  $variation_id , $meta_key , $meta_value );
=======
function delete_variation_meta($variation_id, $meta_key, $meta_value = '') {
	return delete_metadata('variation', $variation_id, $meta_key, $meta_value);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Retrieve variation meta field for a variation.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
 * @link http://codex.wordpress.org/Function_Reference/get_variation_meta
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $variation_id variation ID.
 * @param string $key Optional. The meta key to retrieve. By default, returns data for all keys.
 * @param bool $single Whether to return a single value.
 * @return mixed Will be an array if $single is false. Will be value of meta data field if $single
 *  is true.
 */
<<<<<<< HEAD
function get_variation_meta( $variation_id , $key = '' , $single = false ) {
	return get_metadata( 'variation' , $variation_id , $key, $single );
=======
function get_variation_meta($variation_id, $key = '', $single = false) {
	return get_metadata('variation', $variation_id, $key, $single);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 *  Determine if a meta key is set for a given variation.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
 * @link http://codex.wordpress.org/Function_Reference/get_variation_meta
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $variation_id variation ID.
 * @param string $key Optional. The meta key to retrieve. By default, returns data for all keys.
* @return boolean true of the key is set, false if not.
 *  is true.
 */
<<<<<<< HEAD
function variation_meta_exists( $variation_id , $meta_key ) {
	return metadata_exists( 'variation' , $variation_id , $meta_key );
}

=======
function variation_meta_exists($variation_id, $meta_key ) {
	return metadata_exists( 'variation', $variation_id, $meta_key );

}




>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
/**
 * Update variation meta field based on variation ID.
 *
 * Use the $prev_value parameter to differentiate between meta fields with the
 * same key and variation ID.
 *
 * If the meta field for the variation does not exist, it will be added.

 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param int $variation_id $variation ID.
 * @param string $meta_key Metadata key.
 * @param mixed $meta_value Metadata value.
 * @param mixed $prev_value Optional. Previous value to check before removing.
 * @return bool False on failure, true if success.
 */
<<<<<<< HEAD
function update_variation_meta( $variation_id , $meta_key , $meta_value , $prev_value = '' ) {
	return update_metadata( 'variation' , $variation_id , $meta_key , $meta_value , $prev_value );
=======
function update_variation_meta($variation_id, $meta_key, $meta_value, $prev_value = '') {
	return update_metadata('variation', $variation_id, $meta_key, $meta_value, $prev_value);
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Delete everything from variation meta matching meta key.
 * This meta data function mirrors a corresponding wordpress post meta function.
 * @since 3.9.0
<<<<<<< HEAD
=======
 * @uses $wpdb
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
 *
 * @param string $variation_meta_key Key to search for when deleting.
 * @return bool Whether the variation meta key was deleted from the database
 */
<<<<<<< HEAD
function delete_variation_meta_by_key( $variation_meta_key ) {
	return delete_metadata( 'variation' , null , $variation_meta_key , '' , true );
=======
function delete_variation_meta_by_key($variation_meta_key) {
	return delete_metadata( 'variation', null, $variation_meta_key, '', true );
>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
}

/**
 * Retrieve variation meta fields, based on variation ID.
 *
 * The variation meta fields are retrieved from the cache where possible,
 * so the function is optimized to be called more than once.
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
 *
 * @param int $variation_id variation ID.
 * @return array
 */
function get_variation_custom( $variation_id = 0 ) {
	$variation_id = absint( $variation_id );
<<<<<<< HEAD
=======
	if ( ! $variation_id )
		$variation_id = get_the_ID();

>>>>>>> d78c331f7eafb2d24a7bad174f842a09ed2fae69
	return get_variation_meta( $variation_id );
}

/**
 * Retrieve meta field names for a variation.
 *
 * If there are no meta fields, then nothing (null) will be returned.
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
 *
 * @param int $variation_id variation ID
 * @return array|null Either array of the keys, or null if keys could not be retrieved.
 */
function get_variation_custom_keys( $variation_id = 0 ) {
	$custom = get_variation_custom( $variation_id );

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
 * Retrieve values for a custom variation field.
 *
 * The parameters must not be considered optional. All of the variation meta fields
 * will be retrieved and only the meta field key values returned.
 * This meta data function mirrors a corresponding wordpress post meta function.
 *
 * @since 3.9.0
 *
 * @param string $key Meta field key.
 * @param int $variation_id variation ID
 * @return array Meta field values.
 */
function get_variation_custom_values( $key = '', $variation_id = 0 ) {
	if ( !$key )
		return null;

<<<<<<< HEAD
	$custom = get_variation_custom( $variation_id );

	return isset( $custom[$key] ) ? $custom[$key] : null;
=======
	$custom = get_variation_custom($variation_id);

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
function get_variation_meta_timestamp( $variation_id, $meta_key  ) {
	return wpsc_get_metadata_timestamp( 'variation', $variation_id, $meta_key );
}



