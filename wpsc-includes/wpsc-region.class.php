<?php

/**
 * a geographic region
 *
 * Note: region properties are accessed though methods instead of directly.  This is intentional
 * so that in the future we have the opportunity to manipulate region data before it leaves the class.
 * Might be something foreseeable like translation tables, or could be something we haven't envisioned.
 *
 * @access public
 *
 * @since 3.8.14
 *
 * @param int|string required the country identifier, can be the string ISO code, or the
 *                                          numeric WPeC country id.
 *
 * @param int|string|null|array required the region identifier, can be the text region code, or the
 *                                          numeric region id, if an array is passed a new region will
 *                                          be created and saved in the permanent data store
 *
 * @return object WPSC_Region
 */
class WPSC_Region {

	/**
	 * constructor for a region object
	 *
	 * If null is passed for parameters an empty region is created
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @param int|string|null required $country    The country identifier, can be the string ISO code,
	 *                                                      or the numeric wpec country id
	 *
	 * @param int|string|null|array required $region     The region identifier, can be the text region code,
	 *                                                      or the numeric region id, if an array is passed a
	 *                                                      new region will be created and saved in the permanent
	 *                                                      data store
	 */
	public function __construct( $country = false, $region = false ) {

		// if a country id or code is passed make sure we have a valid country_id
		$country_id = $country ? WPSC_Countries::get_country_id( $country ) : 0;

		// if we are creating a region use the country_id we just validated and get the region code
		if ( is_array( $region ) ) {

			$region['country_id'] = $country_id;
			if ( ! empty( $country ) ) {
				$this->_country_id = $country;
			} else {
				$this->_country_id = $region['country_id'];
			}

			if ( isset( $region['id'] ) ) {
				$this->_id = $region['id'];
			}

			if ( isset( $region['code'] ) ) {
				$this->_code = $region['code'];
			}

			if ( isset( $region['name'] ) ) {
				$this->_name = $region['name'];
			}

			if ( isset( $region['tax'] ) ) {
				$this->_tax = $region['tax'];
			}

		} else {

			$region_id_or_code = $region;

			// if we have both a country country id and a region id/code we can construct this object
			if ( $country && $region_id_or_code ) {
				$region_id = WPSC_Countries::get_region_id( $country_id, $region_id_or_code );

				if ( $country_id && $region_id ) {
					$wpsc_country = new WPSC_Country( $country_id );
					$wpsc_region  = $wpsc_country->get_region( $region_id );

					if ( $wpsc_region ) {
						$this->_code       = $wpsc_region->_code;
						$this->_id         = $wpsc_region->_id;
						$this->_country_id = $wpsc_region->_country_id;
						$this->_name       = $wpsc_region->_name;
						$this->_tax        = $wpsc_region->_tax;
					}
				}
			}
		}
	}

	/**
	 * get region's name
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return string region name
	 */
	public function get_name() {
		return $this->_name;
	}

	/**
	 * get region's numeric id
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return int region id
	 */
	public function get_id() {
		return $this->_id;
	}

	/**
	 * get region's code
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return string region code
	 */
	public function get_code() {
		return $this->_code;
	}

	/**
	 * get region's tax percentage
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return float tax percentage
	 */
	public function get_tax() {
		return $this->_tax;
	}

	/**
	 * get region's country id
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return void
	 */
	public function get_country_id() {
		return $this->_country_id;
	}


	/**
	 * get a region's information as an array
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return void
	 */
	public function as_array() {
		$result = array(
			'id'         => $this->_id,
			'country_id' => $this->_country_id,
			'name'       => $this->_name,
			'code'       => $this->_code,
			'tax'        => $this->_tax,
		);

		return $result;
	}

	/**
	 * returns a property matching the key, either a well know property or a property defined elsewhere
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return varies    value of the property
	 */
	public function get( $key ) {

		$property_name = '_' . $key;

		if ( property_exists( $this, $property_name ) ) {
			$value = $this->$property_name;
		} else {
			$value = wpsc_get_meta( $this->_id, $key, __CLASS__ );
		}

		return apply_filters( 'wpsc_region_get_property', $value, $key, $this );
	}


	/**
	 * sets a property for a region, well-known properties are not allowed to be set using this function,
	 * but arbitrary properties can be set (and accessed later with get)
	 *
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return self, to support method chaining
	 */
	public function set( $property, $value = '' ) {

		if ( is_array( $property ) ) {
			foreach ( $property as $key => $value ) {
				$this->set( $key, $value );
			}
		} else {

			$key = $property;

			$property_name = '_' . $key;

			if ( property_exists( $this, $property_name ) ) {
				$value = $this->$property_name;
				_wpsc_doing_it_wrong( __FUNCTION__, __( 'Using set to change a well-known WPSC_Region property is deprecated as of version 3.8.14.  Use the class constructor and specify all properties together to perform and insert or an update.', 'wpsc' ), '3.8.14' );
				if ( defined( 'WPSC_LOAD_DEPRECATED' ) && WPSC_LOAD_DEPRECATED ) {
					$country_array         = $this->as_array();
					$country_array[ $key ] = $value;
					$this->_save_region_data( $country_array );
				}
			} else {
				wpsc_update_meta( $this->_id, $key, $value, __CLASS__ );
			}
		}

		return $this;
	}


	/**
	 * private region class properties - note that they are marked as public so this object can
	 * be serialized, not to provide access. Consider yourself warned!
	 *
	 * @access private
	 *
	 * @since 3.8.14
	 *
	 */
	private $_id = false;
	private $_country_id = '';
	private $_name = '';
	private $_code = '';
	private $_tax = 0;
}

