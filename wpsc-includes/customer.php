<?php

add_action( 'wpsc_set_cart_item'         , '_wpsc_update_customer_last_active_wrapper' );
add_action( 'wpsc_add_item'              , '_wpsc_update_customer_last_active_wrapper' );
add_action( 'wpsc_before_submit_checkout', '_wpsc_update_customer_last_active_wrapper' );

function _wpsc_update_customer_last_active_wrapper() {
	_wpsc_update_customer_last_active();
}

/**
 * Helper function for setting the customer cookie content and expiration
 *
 * @since  3.8.13
 * @access private
 * @param  mixed $cookie  Cookie data
 * @param  int   $expire  Expiration timestamp
 */
function _wpsc_set_customer_cookie( $cookie, $expire ) {
	// we set the cookie to non-secure so that it is available to shoppers on both secure an non-secure pages
	$secure = false;
	$success = setcookie( WPSC_CUSTOMER_COOKIE, $cookie, $expire, WPSC_CUSTOMER_COOKIE_PATH, COOKIE_DOMAIN, $secure, true );

	if ( $expire < time() )
		unset( $_COOKIE[WPSC_CUSTOMER_COOKIE] );
	else
		$_COOKIE[WPSC_CUSTOMER_COOKIE] = $cookie;
}


/** A string unique to this installation of WPEC that we use to protect customer cookies
 * @return string a unique key
 */
function _wpsc_customer_id_validation_key() {

	$customer_id_validation_key = get_option( 'wpsc_customer_id_validation_key' , false);
	if ( !$customer_id_validation_key ) {
		// store a unique string to use as the key, the current PHP session identifier
		// should be as good as anything else we can come up with
		update_option( 'wpsc_customer_id_validation_key' , $customer_id_validation_key = session_id() );
	}

	return $customer_id_validation_key;
}

/**
 * In case the user is not logged in, create a new user account and store its ID
 * in a cookie
 *
 * @access public
 * @since 3.8.9
 * @return string Customer ID
 */
function wpsc_create_customer_id() {

	///////////////////////////////////////////////////////////////////////////////////////////
	// NOTE: the customer id is statically cached so that if the customer cookie is manipulated
	// after the id is retrieved the customer id will still remain the same for the remainder
	static $cached_current_customer_id = false;

	if ( $cached_current_customer_id === false ) {

		if ( $is_a_bot_user = wpsc_is_bot_user() ) {
			$cached_bot_user_id = get_transient( 'wpsc_bot_user_id');
			if ( $cached_bot_user_id == false ) {
				$username = '_wpsc_bot';
				$wp_user = get_user_by( 'login', $username );
				if ( $wp_user === false ) {
					$password = wp_generate_password( 12, false );
					$id = wp_create_user( $username, $password );
					set_transient( 'wpsc_bot_user_id' , $id);
				} else {
					$id = $wp_user->ID;
				}

			} else {
				$id = $cached_bot_user_id;
			}

			$cached_current_customer_id = $id;

		} else {
			$id = _wpsc_get_customer_wp_user_id();

			$expire = time() + WPSC_CUSTOMER_DATA_EXPIRATION; // valid for 48 hours
			/////////////////////////////////////////////////////////////////////////////////////////
			// NOTE: a unique string (in this case the php session id) is combined to the data being
			// hashed so the customer cookie is more difficult to fake.  Brute force sequential
			// faking of the customer cookie could be used to gain access to the customers profile
			// data.  The profile data could contain personal information that we don't want exposed.
			// The session id is stored in the customer profile and used to validate the customer cookie.
			$data = $id . $expire . _wpsc_customer_id_validation_key();
			$hash = hash_hmac( 'md5', $data, wp_hash( $data ) );
			$cookie = $id . '|' . $expire . '|' . $hash;

			// store ID, expire and hash to validate later
			_wpsc_set_customer_cookie( $cookie, $expire );
		}

		$cached_current_customer_id = $id;
	}

	if ( ( $current_user_id = get_current_user_id() ) !== 0 ) {
		return $current_user_id;
	}

	return $cached_current_customer_id;
}

/**
 * Make sure the customer cookie is not compromised.
 *
 * @access public
 * @since 3.8.9
 * @return mixed Return the customer ID if the cookie is valid, false if otherwise.
 */
function wpsc_validate_customer_cookie() {
	static $validated_user_id = false;

	// we hold on to the validated user id once we have it becuase this function might
	// be called many times per url request.
	if ( $validated_user_id !== false )
		return $validated_user_id;

	$cookie = $_COOKIE[WPSC_CUSTOMER_COOKIE];
	list( $id, $expire, $hash ) = $x = explode( '|', $cookie );

	/////////////////////////////////////////////////////////////////////////////////////////
	// NOTE: a unique string (in this case the php session id) is combined to the data being
	// hashed so the customer cookie is more difficult to fake.  Brute force sequential
	// faking of the customer cookie could be used to gain access to the customers profile
	// data.  The profile data could contain personal information that we don't want exposed.
	// The session id is stored in the customer profile and used to validate the customer cookie.
	$data = $id . $expire . _wpsc_customer_id_validation_key();
	$hmac = hash_hmac( 'md5', $data, wp_hash( $data ) );

	if ( ($hmac != $hash) || empty( $id ) || !is_numeric($id)) {
		return false;
	} else {
		// check to be sure the user still exists, could have been purged
		$id = intval( $id );
		$wp_user = get_user_by( 'id', $id );
		if ( $wp_user === false ) {
			return false;
		}
	}

	$validated_user_id = $id;
	return $id;
}

/**
 * Get current customer ID.
 *
 * If the user is logged in, return the user ID. Otherwise return the ID associated
 * with the customer's cookie.
 *
 * If $mode is set to 'create', WPEC will create the customer ID if it hasn't
 * already been created yet.
 *
 * @access public
 * @since 3.8.9
 * @return mixed        User ID (if logged in) or customer cookie ID
 */
function wpsc_get_current_customer_id() {
	static $cached_customer_id = false;

	if ( $cached_customer_id === false ) {

		// if the user is logged in we use the user id
		if ( is_user_logged_in() ) {
			$cached_customer_id = get_current_user_id();
		} elseif ( isset( $_COOKIE[WPSC_CUSTOMER_COOKIE] ) ) {
			// check the customer cookie, get the id, or if that doesn't work move on and create the user
			$id = wpsc_validate_customer_cookie();
			if ( $id != false ) {
				$cached_customer_id = $id;
			}
		}

		if ( $cached_customer_id == false ) {
			$cached_customer_id = wpsc_create_customer_id();
		}

		do_action( 'wpsc_have_customer_id', $cached_customer_id );
	}

	return $cached_customer_id;
}

/**
 * Setup current user object and customer ID as well as cart.
 *
 * @uses  do_action() Calls 'wpsc_setup_customer' after customer data is ready
 *
 * @access private
 * @since  3.8.13
 */
function _wpsc_action_setup_customer() {
	wpsc_get_current_customer_id();
	wpsc_core_setup_cart();
	do_action( 'wpsc_setup_customer' );
}

/**
 * Return the internal customer meta key, which depends on the blog prefix
 * if this is a multi-site installation.
 *
 * @since  3.8.13
 * @access private
 * @param  string $key Meta key
 * @return string      Internal meta key
 */
function _wpsc_get_customer_meta_key( $key ) {
	$blog_prefix = is_multisite() ? $wpdb->get_blog_prefix() : '';
	return "{$blog_prefix}_wpsc_{$key}";
}

/**
 * Delete all customer meta for a certain customer ID
 *
 * @since  3.8.9.4
 * @param  string|int $id Customer ID. Optional. Defaults to current customer
 * @return boolean        True if successful, False if otherwise
 */
function wpsc_delete_all_customer_meta( $id = false ) {
	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	$meta = get_user_meta( $id );
	$blog_prefix = is_multisite() ? $wpdb->get_blog_prefix() : '';
	$key_pattern = "{$blog_prefix}_wpsc_";
	$success = true;

	foreach ( $meta as $key => $value ) {
		if ( strpos( $key, $key_pattern ) === 0 )
			$success = $success && delete_user_meta( $id, $key );
	}

	return $success;
}

/**
 * Delete customer meta.
 *
 * @access public
 * @since  3.8.9
 * @param  string     $key  Meta key
 * @param  string|int $id   Customer ID. Optional. Defaults to current customer.
 * @return boolean|WP_Error True if successful. False if not successful. WP_Error
 *                          if there are any errors.
 */
function wpsc_delete_customer_meta( $key, $id = false ) {
	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	$success = delete_user_meta( $id, _wpsc_get_customer_meta_key( $key ) );

	// notification when any meta item has changed
	if ( $success && has_action( $action = 'wpsc_deleted_customer_meta' ) ) {
		do_action( $action, $key, $id );
	}

	// notification when a specific meta item has changed
	if ( $success && has_action( $action = 'wpsc_deleted_customer_meta_' . $key  ) ) {
		do_action( $action, $key, $id );
	}

	return $success;
}

/**
 * Update a customer meta.
 *
 * @access public
 * @since  3.8.9
 * @param  string     $key   Meta key
 * @param  mixed      $value Meta value
 * @param  string|int $id    Customer ID. Optional. Defaults to current customer.
 * @return boolean|WP_Error  True if successful, false if not successful, WP_Error
 *                           if there are any errors.
 */
function wpsc_update_customer_meta( $key, $value, $id = false ) {
	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	$success = update_user_meta( $id, _wpsc_get_customer_meta_key( $key ), $value );

	// notification when any meta item has changed
	if ( $success && has_action( $action = 'wpsc_updated_customer_meta' ) ) {
		do_action( $action, $value, $key, $id );
	}

	// notification when a specific meta item has changed
	if ( $success && has_action( $action = 'wpsc_updated_customer_meta_' . $key  ) ) {
		do_action( $action, $value, $key, $id );
	}

	return $success;
}

/**
 * Overwrite customer meta with an array of meta_key => meta_value.
 *
 * @access public
 * @since  3.8.9
 * @param  array      $profile Customer meta array
 * @param  int|string $id      Customer ID. Optional. Defaults to current customer.
 * @return boolean             True if meta values are updated successfully. False
 *                             if otherwise.
 */
function wpsc_update_all_customer_meta( $profile, $id = false ) {
	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	wpsc_delete_all_customer_meta( $id );
	$success = true;

	foreach ( $profile as $key => $value ) {
		$success = $success && wpsc_update_customer_meta( $key, $value, $id );
	}

	return $success;
}

/**
 * Get a customer meta value.
 *
 * @access public
 * @since  3.8.9
 * @param  string  $key Meta key
 * @param  int|string $id  Customer ID. Optional, defaults to current customer
 * @return mixed           Meta value, or null if it doesn't exist or if the
 *                         customer ID is invalid.
 */
function wpsc_get_customer_meta( $key = '', $id = false ) {
	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	$meta_value = get_user_meta( $id, _wpsc_get_customer_meta_key( $key ), true );

	// notification when any meta item has changed
	if ( has_filter( $filter = 'wpsc_get_customer_meta' ) ) {
		$meta_value = apply_filters( $filter,  $meta_value, $key, $id );
	}

	// notification when a specific meta item has changed
	if ( has_filter( $filter = 'wpsc_get_customer_meta_' . $key  ) ) {
		$meta_value = apply_filters( $filter,  $meta_value, $key, $id );
	}

	return $meta_value;
}

/**
 * Return an array containing all metadata of a customer
 *
 * @access public
 * @since 3.8.9
 * @param  mixed $id Customer ID. Default to the current user ID.
 * @return WP_Error|array Return an array of metadata if no error occurs, WP_Error
 *                        if otherwise.
 */
function wpsc_get_all_customer_meta( $id = false ) {
	global $wpdb;

	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	$meta = get_user_meta( $id );
	$blog_prefix = is_multisite() ? $wpdb->get_blog_prefix() : '';
	$key_pattern = "{$blog_prefix}_wpsc_";

	$return = array();

	// if a meta item is being aliases or emulated this gives the logic the chance to adjust the keys and values
	// in bulk
	if ( has_filter( 'wpsc_get_all_customer_meta' ) ) {
		$meta = apply_filters( 'wpsc_get_all_customer_meta', $meta , $id );
	}

	foreach ( $meta as $key => $value ) {
		if ( strpos( $key, $key_pattern ) === FALSE )
			continue;

		$short_key = str_replace( $key_pattern, '', $key );
		$return[$short_key] = $value[0];

		// notification when a specific meta item has changed
		if ( has_filter( $filter = 'wpsc_get_customer_meta_' . $short_key  ) ) {
			$return[$short_key] = apply_filters( $filter,  $return[$short_key], $short_key, $id );
		}
	}

	return $return;
}

/**
 * Return an the customer cart
 *
 * @access public
 * @since 3.8.9
 * @param  mixed $id Customer ID. Default to the current user ID.
 * @return WP_Error|array Return an array of metadata if no error occurs, WP_Error
 *                        if otherwise.
 */
function wpsc_get_customer_cart( $id = false  ) {

	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	$cart = maybe_unserialize( base64_decode( wpsc_get_customer_meta( 'cart', $id ) ) );

	if ( !( is_object( $cart ) && ! is_wp_error( $cart ) ) ) {
		$cart = new wpsc_cart();
	}

	return $cart;
}


function wpsc_update_customer_cart( $id = false, $cart ) {
	global $wpdb, $wpsc_start_time, $wpsc_cart;

	if ( !is_a( $cart,'wpsc_cart' ) )
		return false;

	if ( $id == wpsc_get_current_customer_id() ) {
		$wpsc_cart = $cart;
	}

	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	wpsc_update_customer_meta( 'cart', base64_encode( serialize( $cart ) ) , $id );

	$wpsc_cart->clear_cache(); // do this to fire off actions that happen when a cart is changed

	return true;
}



function _wpsc_user_has_role( $roles, $id = false ) {

	$user_in_role = false;

	if ( !empty( $roles ) ) {

		if ( ! $id )
			$id = wpsc_get_current_customer_id();

		$user = get_userdata( $id );

		if ( !empty( $user ) ) {

			if ( !is_array( $roles ) ) {
				$roles = array( $roles );
			}

			// Loop through user roles
			foreach ( $user->roles as $role ) {
				// Does user have role?
				if ( in_array( $role, $roles ) ) {
					$user_in_role = true;
					break;
				}
			}
		}
	}

	return $user_in_role;
}


/**
 * Update the customer's last active time
 *
 * @access private
 * @since  3.8.13
 */
function _wpsc_update_customer_last_active( $hours = 48, $id = false ) {

	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	wpsc_update_customer_meta( 'last_active', time(), $id );

	if ( _wpsc_user_has_role(  'wpsc_anonymous', $id  ) ) {
		// handle the expiration of the temporary customer profiles
		$current_expire_time = wpsc_get_customer_meta( 'temporary_profile', $id,  true );
		if ( empty( $current_expire_time ) )
			$current_expire_time = 0;

		$keep_profile_until = time() +  $hours * 60 * 60;

		// if the expire time is being advanced by more than an hour do the update, otherwise
		// don't do anything.  No reason to have another database hit on every http request!
		if ( ($keep_profile_until - $current_expire_time) > 3600 ) {
			wpsc_update_customer_meta( 'temporary_profile', $keep_profile_until,  $id );
		}
	} else {
		$temp_value = wpsc_get_customer_meta( 'temporary_profile', $id );
		if ( !empty( $temp_value ) ) {
			bling_log( 'Delete _wpsc_temporary_profile for user id ' . $id );
			wpsc_delete_customer_meta( 'temporary_profile', $id );
		}
	}
}


/**
 * Is the user an automata not worthy of a WPEC profile to hold shopping cart and other info
 *
 * @access public
 * @since  3.8.13
 */
function wpsc_is_bot_user() {

	static $is_a_bot_user = null;

	if ( $is_a_bot_user !== null ) {
		return $is_a_bot_user;
	}

	if ( is_user_logged_in() ) {
		$is_a_bot_user = false;
		return false;
	}

	// XML RPC requests are probably from cybernetic beasts
	if ( defined('XMLRPC_REQUEST') && XMLRPC_REQUEST ) {
		$is_a_bot_user = true;
		return true;
	}

	// request uri checks
	if ( !empty($_SERVER['REQUEST_URI']) ) {
		// coming to login first, after the user logs in or registers we know they are a live being, until
		// then they are something else
		if ( (stripos( $_SERVER['REQUEST_URI'], 'wp-login' ) !== false )
				|| ( stripos( $_SERVER['REQUEST_URI'], 'wp-register' ) !== false )
		) {
			$is_a_bot_user = true;
			return true;
		}

		// a cron request from a uri?
		if ( strpos( $_SERVER['REQUEST_URI'], 'wp-cron.php' ) !== false ) {
			$is_a_bot_user = true;
			return true;
		}

		if ( strpos( $_SERVER['REQUEST_URI'], '?wpsc_action=rss' ) !== false) {
			$is_a_bot_user = true;
			return true;
		}

		if ( preg_match( '|/feed/$|i', $_SERVER['REQUEST_URI'] ) === 1) {
			$is_a_bot_user = true;
			return true;
		}
	}

	// user agent checks
	if ( !empty($_SERVER['HTTP_USER_AGENT']) ) {
		// even web servers talk to themselves when they think no one is listening
		if ( (stripos( $_SERVER['HTTP_USER_AGENT'], 'wordpress' ) !== false) ) {
			$is_a_bot_user = true;
			return true;
		}

		// the user agent could be google bot, bing bot or some other bot,  one would hope real user agents do not have the
		// string 'bot|spider|crawler|preview' in them, there are bots that don't do us the kindness of identifying themselves as such,
		// check for the user being logged in in a real user is using a bot to access content from our site
		if ( ( stripos( $_SERVER['HTTP_USER_AGENT'], 'bot' ) !== false )
				|| ( stripos( $_SERVER['HTTP_USER_AGENT'], 'crawler' ) !== false )
					|| ( stripos( $_SERVER['HTTP_USER_AGENT'], 'spider' ) !== false )
						|| ( stripos( $_SERVER['HTTP_USER_AGENT'], 'preview' ) !== false )
							|| ( stripos( $_SERVER['HTTP_USER_AGENT'], 'squider' ) !== false )
								|| ( stripos( $_SERVER['HTTP_USER_AGENT'], 'slurp' ) !== false )
									|| ( stripos( $_SERVER['HTTP_USER_AGENT'], 'pinterest.com' ) !== false )
		) {
			$is_a_bot_user = true;
			return true;
		}
	}

	$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	if ( ( stripos( $hostname, 'search.msn.com' ) !== false )
			|| ( stripos( $hostname, '.amazonaws.com' ) !== false )
	) {
		$is_a_bot_user = true;
		return true;
	}


	$is_a_bot_user = false;

	// at this point we have eliminated all but the most obvious choice, a human (or cylon?)
	return false;
}


/**
 * Attach a purchase log to our customer profile
 *
 * @access private
 * @since  3.8.13
 */
function _wpsc_set_purchase_log_customer_id( $data ) {

	// if there is a purchase log for this user we don't want to delete the
	// user id, even if the transaction isn't successful.  there may be useful
	// information in the customer profile related to the transaction
	wpsc_delete_customer_meta('_wpsc_temporary_profile');

	// if there isn't already user id we set the user id of the current customer id
	if ( empty ( $data['user_ID'] ) ) {
		$id = wpsc_get_current_customer_id();
		$data['user_ID'] = $id;
	}

	return $data;
}

if ( !is_user_logged_in() ) {
	add_filter( 'wpsc_purchase_log_update_data', '_wpsc_set_purchase_log_customer_id', 1, 1 );
	add_filter( 'wpsc_purchase_log_insert_data', '_wpsc_set_purchase_log_customer_id', 1, 1 );
}


/**
 * Create a hash from what we know about a user's connection to try to determine if it is unique
 *
 * @access private
 * @since  3.8.13
 */
function _wpsc_user_hash_meta_key() {
	$agent = empty( $_SERVER['HTTP_USER_AGENT'] ) ? '(unknown agent)' : $_SERVER['HTTP_USER_AGENT'] ;
	$user_hash_meta_key = '_wpsc_' . md5( $_SERVER['REMOTE_ADDR'] .  $agent );
	return $user_hash_meta_key;
}

/**
 * Check users with similar information to see if they were created in the last
 * milliseconds so that we don't create two users when two requests come to the server
 * in parallel.
 *
 * Why do we do this?
 * WPEC creates a user profile for each visitor at the start of each visit. The user profile is used
 * to hold information like the cart contents, shipping data, checkout errors, or anything that a WPEC
 * aware plug-in may wish to save with the user.
 *
 * Creating the profile as soon as the user starts a visit has some advantages over waiting
 * until there is data to save before creating the profile. Mostly it allows code to be written
 * knowing that the user visit information can be saved to the profile without worrying about if
 * any special initialization has taken place.
 *
 * It also has some disadvantages that need to be addressed. In addition to detecting if a visit is
 * some type of bot, handled in _wpsc_is_bot, we need to make sure multiple profiles are not
 * inadvertently created.  How can this happen?
 *
 * Consider this common scenario.  WPEC based site is built and used page caching, a page that is cached is
 * is delivered to a real user.  When that page is delivered Wordpress/WPEC typically is unaware that anything
 * has taken place because the cache software/hardware has done all of the communication with the user's browser.
 *
 * The browser parses and processes the cached page HTML and java script.  When the page is processed there are
 * embedded AJAX calls, or other HTTP requests that are serviced by WPEC/Wordpress.  Modern browsers make the requests
 * to the server in parallel.  THat means that a web server might have as many as 4-8 requests working at the same time,
 * none of which has the WPEC customer cookie set.
 *
 * Without some means of detecting that each of these requests is coming from the same live user, a new user profile would
 * be created for each request, and a unique customer cookie would be set in each request.  That's
 * kind of messy.  It also could cause a problem if one of the HTTP requests coming to the server was an add to cart
 * operation.  An item could be added to the cart, show on the users screen as in the cart, but not be there when the
 * user goes to checkout because the cookie from a different request was what was ultimately set in the user's
 * web browser. Keep in mind that hte JAX requests that create a user profile don't have to be WPEC requests. They
 * could be requests from any plugin, doing anything that the plug-in intended.
 *
 * We are limited in what we can do to detect a common source for multiple requests. We look at the originating
 * IP address, the user agent string and the time.  If the user agent and the ip address are the same, and the time
 * is within half a second of a previous create profile request we treat the requests as coming from the same user.
 *
 *  When does this fail? Two users both behind the same caching proxy, or NAT firewall, who both go to the same website,
 *  and the pages they go to are cached, and they do it at almost exactly the same time.
 *
 * @access private
 * @since  3.8.13
 */
function _wpsc_get_customer_wp_user_id() {
	global $wp_roles;
	global $wpdb;

	$user_name_prefix       = '_' . _wpsc_user_hash_meta_key();
	$user_name_suffix       = '';
	$user_name_check_count  = 0;
	$avoid_infinite_loop    = 0;
	$password               = wp_generate_password( 12, false );
	$user_id                = false;
	$existing_user			= false;
	$create_user_result     = '';

	if ( is_user_logged_in() && ( $current_user_id = get_current_user_id() ) !== 0 ) {
		return $current_user_id;
	}

	while( $user_id === false) {

		$result = $wpdb->query('START TRANSACTION');

		$user_name_to_look_for = $user_name_prefix . $user_name_suffix;
		$sql = 'SELECT ID, user_registered FROM ' . $wpdb->users . ' WHERE user_login = "' . $user_name_to_look_for . '"';

		$users_with_this_login_name = $wpdb->get_results( $sql );
		if ( empty ( $users_with_this_login_name ) ) {
			$users_with_this_login_name_count = 0;
		} else {
			$users_with_this_login_name_count = count( $users_with_this_login_name );
		}

		if ( $users_with_this_login_name_count > 1 ) {
			;//_wpsc_doing_it_wrong( __FUNCTION__, 'Too many users with the login '. $user_name_to_look_for . ' loop count is: ' . $avoid_infinite_loop );
		}

		if ( $users_with_this_login_name_count == 0 ) {
			$user_registered = gmdate('Y-m-d H:i:s');
			$db_result = $wpdb->insert(
										$wpdb->users,
										array(
												'user_login'      => $user_name_to_look_for,
												'user_pass'       => $password,
												'user_registered' => $user_registered
										),
										array(
												'%s',
												'%s',
												'%s'
										)
									);

			if ( $db_result !== false ) {
				$create_user_result = (int) $wpdb->insert_id;
				$existing_user = $create_user_result;
			} else {
				$create_user_result = '';
			}

		} elseif ( $users_with_this_login_name_count ) {

			$existing_user = false;

			foreach ( $users_with_this_login_name as $user ) {

				$existing_user_to_check = $user->ID;//get_user_by( 'login', $user_name_to_look_for );

				if  ( !empty( $user->user_registered ) )
					$user_registered_time = strtotime( $user->user_registered );
				else
					$user_registered_time = 0;

				$how_long_ago = abs ( time() - $user_registered_time );

				if ( $how_long_ago < 200 ) { // users created with within 20 seconds are treated as this user
					$existing_user = $existing_user_to_check;
					break;
				}
			}

			if ( !$existing_user ) {
				$user_name_check_count++;
				$user_name_suffix = ('_' . str_pad( $user_name_check_count, 2, "0", STR_PAD_LEFT ) );
				$create_user_result = '';
			}
		}

		// At this point we check to see if there is more than one user with our user login name.  This can happen
		// because although Wordpress requires that login names are unique, however Wordpress doesn't enforce the
		// requirement with a unique restriction on the column index.  If two requests from the same user come in
		// at close to the same time both insert user requests can succeed. The two requests can be any combination
		// of get requests for the page's html, ajax requests, or http get/post requests processing forms.

		$sql = 'SELECT count(*) FROM ' . $wpdb->users . ' WHERE user_login = "' . $user_name_to_look_for . '"';
		$user_count = $wpdb->get_var( $sql );

		// if we created a user and the user count count is more than one we should fail this transaction
		if ( $user_count > 1 && !empty( $create_user_result) ) {
			$existing_user = '';
		}

		// If there is only one user wit the login we are considering then we are good to go,
		// if there is more than one, and it is the same number as existed hwne we started we can also
		// move on.  This second condition should never happen, but we can't risk not checking.
		if ( !empty( $existing_user ) ){
			$result = $wpdb->query('COMMIT');

			if ( !empty( $create_user_result) ) {
				// one last check
				$sql = 'SELECT count(*) FROM ' . $wpdb->users . ' WHERE user_login = "' . $user_name_to_look_for . '"';
				$user_count = $wpdb->get_var( $sql );

				if ( $user_count != 1) {
					$delete_result = $wpdb->delete( $wpdb->users, array( 'ID' => $create_user_result ) );
					$create_user_result = '';
					continue;
				}
			}

			if ( !empty( $create_user_result) ) {

				$wordpress_user = new WP_User( $create_user_result );

				// we created a user, let's do some initialization
				$role = $wp_roles->get_role( 'wpsc_anonymous' );

				if ( ! $role )
					$wp_roles->add_role( 'wpsc_anonymous', __( 'Anonymous', 'wpsc' ) );

				$wordpress_user->set_role( 'wpsc_anonymous' );

				wpsc_update_customer_meta( 'last_active', time(), $create_user_result );

				// we set the delete ticker low knowing it will be set to a bigger number on the first user
				// action.  this will cause profiles that only a single page view to be deleted sooner
				// uncluttering our user table and cache.
				_wpsc_update_customer_last_active( 2, $create_user_result );
			}

			if ( ($users_with_this_login_name_count == 0) && ($user_count == 1) ) {
				do_action( 'wpsc_created_user_profile', $user_id );
			}

			// at this point we have identified the user we are looking for, the id is $existing_user
			$user_id = $existing_user;
		} else {
			// here we do some cleanup to make sure all of our data is in sync, we'll loop back and try again
			$result = $wpdb->query('ROLLBACK');

			if ( !empty( $existing_user ) ) {
				wp_cache_delete($existing_user, 'users');
			}

			if ( !empty( $create_user_result ) ) {
				wp_cache_delete($create_user_result, 'users');
			}

			if ( !empty( $user_name_to_look_for ) ) {
				wp_cache_delete($user_name_to_look_for, 'userlogins');
			}
		}

		// this should never happen, but infinite loops are really bad so we'll check anyway
		if ( $avoid_infinite_loop++ > 10000 )
			exit(0);

	}

	return $user_id;

}


/** get the count of posts by the customer
 * @param string $id
 * @return unknown
 */
function wpsc_customer_post_count( $id = false ) {

	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	return count_user_posts( $id );
}


/** get the count of comments by the customer
 * @param string $id
 * @return unknown
 */
function wpsc_customer_comment_count( $id = false ) {

	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	global $wpdb;
	$count = $wpdb->get_var('SELECT COUNT(comment_ID) FROM ' . $wpdb->comments. ' WHERE user_id = "' . $id . '"');
	return $count;
}


/** get the count of purchases by the customer
 * @param string $id
 * @return unknown
 */
function wpsc_customer_purchase_count( $id = false ) {

	if ( ! $id )
		$id = wpsc_get_current_customer_id();

	global $wpdb;
	$count = $wpdb->get_var('SELECT COUNT(user_ID) FROM ' . WPSC_TABLE_PURCHASE_LOGS. ' WHERE user_id = "' . $id . '"');
	return $count;
}

wpsc_get_current_customer_id();

function _wpsc_copy_cart_from_anonymous_user() {

	// if the user is logged in and the cookie is still there, delete the cookie
	if ( is_user_logged_in() && isset( $_COOKIE[WPSC_CUSTOMER_COOKIE] ) ) {

		// if the cart from the wpec customer cookie has items, and the cart
		// for the wordpressd user is empty, copy the cart over so the shopper
		// does not use thier work if they register before checking out
		$anonymous_id = wpsc_validate_customer_cookie();
		$wp_id = get_current_user_id();

		if ( $anonymous_id ) {
			$anonymous_cart = wpsc_get_customer_cart( $anonymous_id );
			$wp_cart = wpsc_get_customer_cart( $wp_id );
			if ( $anonymous_cart->cart_item_count && !$wp_cart->cart_item_count ) {
				wpsc_update_customer_cart( $wp_id, $anonymous_cart );
			}
		}

		_wpsc_set_customer_cookie( '', time() - 3600 );
	}
}

add_action( 'wpsc_init', '_wpsc_copy_cart_from_anonymous_user' );
