<?php

/**
 * WPeC Visitor Class
 *
 * @since 3.8.14
 */
class WPSC_Visitor {

	/**
	 * @var bool
	 */
	public $valid = true;

	//////////////////////////////////////////////////////////////////////////////////////////
	// Here are the well known attributes, functionality outside of WPEC should not
	// access these attributes directly, as they are subject to change as the implementation
	// evolves.  Instead use the get and set methods.

	/**
	 * @var bool | int
	 */
	public $_id = false;
	/**
	 * @var bool | int
	 */
	public $_user_id = false;
	/**
	 * @var bool | int
	 */
	public $_last_active = false;
	/**
	 * @var bool | int
	 */
	public $_expires = false;
	/**
	 * @var bool | int
	 */
	public $_created = false;
	/**
	 * @var wpsc_cart|bool|WP_Error
	 */
	public $_cart = false;

	/**
	 * @var array
	 */
	private static $_visitor_meta_attribute_list = array(
		'shippingfirstname',
		'shippinglastname',
		'shippingregion',
		'shippingcountry',
		'shippingpostcode',
		'shippingpostcode',
		'shippingSameBilling',
		'shippingstate',
		'billingfirstname',
		'billinglastname',
		'billingemail',
		'billingaddress',
		'billingcity',
		'billingregion',
		'billingstate',
		'billingcountry',
		'billingphone',
		'billingpostcode',
	);

	// well known attributes from the 'wpsc_visitors table', true false if change allowed

	/**
	 * @var array
	 */
	public static $visitor_table_attribute_list = array(
		'id'          => false,
		'user_id'     => true,
		'last_active' => false,
		'expires'     => false,
		'created'     => false,
	);

	/**
	 * Create visitor class from visitor id
	 *
	 * @param  $visitor_id int unique visitor id
	 *
	 * @since 3.8.14
	 */
	function __construct( $visitor_id ) {

		$this->_cart = new wpsc_cart( false );

		$visitor = _wpsc_get_visitor( $visitor_id );
		if ( $visitor == false ) {
			$this->valid = false;
			return;
		}

		if ( $visitor ) {
			foreach ( $visitor as $key => $value ) {
				$property_name        = '_' . $key;
				$this->$property_name = $value;
			}
		}

		$visitor_meta = wpsc_get_visitor_meta( $visitor_id );

		if ( ! empty( $visitor_meta ) ) {
			foreach ( $visitor_meta as $meta_key => $meta_value ) {
				if ( ( $i = strpos( $meta_key, 'cart.' ) ) === false ) {
					$property_name        = '_' . $meta_key;
					$this->$property_name = $meta_value[0];
				} else {
					$property_name               = substr( $meta_key, strlen( '_wpsc_cart.' ) );
					$this->_cart->$property_name = $meta_value[0];
				}
			}
		}

		$this->_cart = wpsc_get_visitor_cart( $visitor_id );
	}

	/**
	 * Get visitor expiration
	 *
	 * @param  $unix_time boolean  true returns time as unix time, false returns time as string
	 *
	 * @return string expiration time
	 * @since 3.8.14
	 */
	function expiration( $unix_time = true ) {
		if ( ! ( $unix_time = strtotime( $this->_expires ) ) ) {
			return false;
		}

		if ( $unix_time ) {
			return $unix_time;
		}

		return $this->_expires;
	}

	/**
	 * Get visitor attribute
	 *
	 * @param  $attribute attribute name
	 *
	 * @return varies, attribute value
	 * @since 3.8.14
	 */
	function get( $attribute = null ) {

		if ( empty( $attribute ) ) {
			return $this;
		}

		$property_name = $this->property_name( $attribute );

		if ( isset( $this->$property_name ) ) {
			$value = $this->$property_name;
		} else {
			$value = '';
		}

		return $value;
	}

	/**
	 * Get visitor attribute
	 *
	 * @param  $attribute attribute name
	 * @param  $value attribute value
	 *
	 * @return this
	 * @since 3.8.14
	 */
	function set( $attribute, $value ) {

		$property_name = $this->property_name( $attribute );
		$this->$property_name = $value;

		if ( in_array( $attribute, self::$visitor_table_attribute_list ) ) {
			// test if change of the attribute is permitted
			if ( isset( self::$visitor_table_attribute_list[ $attribute ] ) ) {
				wpsc_update_visitor( $this->_id, array( $attribute => $value ) );
			}
		} else {
			wpsc_update_visitor_meta( $this->_id, $attribute, $value );

			return $this;
		}
	}

	/**
	 * Delete visitor attribute
	 *
	 * @param  $attribute attribute name
	 *
	 * @return this
	 * @since 3.8.14
	 */
	function delete( $attribute ) {
		$property_name = $this->property_name( $attribute );
		if ( isset( $this->$property_name ) ) {
			unset( $attribute->$property_name );
		}

		wpsc_delete_visitor_meta( $this->_id, $attribute );

		return $this;

	}

	/**
	 * Does visitor have an attribute
	 *
	 * @param  $attribute attribute name
	 *
	 * @return this
	 * @since 4.0.0
	 */
	function has_property( $attribute ) {
		$property_name = $this->property_name( $attribute );
		return isset( $this->$property_name );
	}


	/**
	 * Does visitor have an attribute with a value
	 *
	 * @param  $attribute attribute name
	 *
	 * @return this
	 * @since 4.0.0
	 */
	function is_empty( $attribute = false ) {
		if ( ! $attribute ) {
			return $this->all_empty();
		}

		$property_name = $this->property_name( $attribute );
		$result = false;

		if ( isset( $this->$property_name ) ) {
			$result = empty( $this->$property_name );
		}

		return $result;
	}

	// helper function for well known variables
	/**
	 * @return int
	 */
	function id() {
		return $this->_id;
	}

	/**
	 * @return bool | int
	 */
	function user_id() {
		return $this->_user_id;
	}

	/**
	 * @return int
	 */
	function last_active() {
		return $this->_last_active;
	}

	/**
	 * Is this shopper active now?
	 *
	 * @param $interval int seconds to check, default is one hour
	 * @return bool
	 */
	function is_active( $interval = HOUR_IN_SECONDS ) {
		$active = ( time() - $interval ) < strtotime( $this->_last_active );
		return $active;
	}

	/**
	 * @return int
	 */
	function created() {
		return $this->_created;
	}

	/**
	 * @return wpsc_cart
	 */
	function cart() {
		return $this->_cart;
	}

	/**
	 * @return bool
	 */
	function all_empty() {
		$result = true;

		if ( $this->_user_id ) {
			$result = false;
		}

		if ( $this->cart()->have_cart_items() ) {
			$result = false;
		}

		if ( $result ) {
			foreach ( self::$_visitor_meta_attribute_list as $property_name ) {
				$value = $this->get( $property_name );
				if ( ! empty( $value ) ) {
					$result = false;
					break;
				}
			}
		}

		return $result;
	}

	private function property_name( $attribute ) {
		return '_' . trim( $attribute );
	}

}