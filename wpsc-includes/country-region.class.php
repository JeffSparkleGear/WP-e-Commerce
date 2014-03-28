<?php

class WPSC_Country_Region {

	/**
	 * How many regions does the country have
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string country being check, if noon-numeric country is treated as an isocode, number is the country id
	 */
	public static function region_count( $country ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$country_index = -1;

		if ( is_numeric( $country ) ) {
			$country_index = intval( $country );
		} else {
			if ( isset( self::$country_iso_code_map[$country] ) ) {
				$country_index = self::$country_iso_code_map[$country];
			}
		}

		$region_count = 0;

		if ( self::$countries[$country_index]->has_regions
				&& property_exists(  self::$countries[$country_index], 'regions' )
					&& is_array(  self::$countries[$country_index]->regions )
		) {
			$region_count = count( self::$countries[$country_index]->regions );
		}

		return $region_count;
	}


	/**
	 * Get the list of countries,
	 *
	 * @access private
	 * @static
	 * @since 3.8.14
	 *
	 * @return array   country list with index as country, value as name, sorted by country name
	 */
	public static function get_countries() {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		// we have the return value in our country name to id map, all we have to do is swap the keys with the values
		return array_flip( self::$country_names );
	}


	/**
	 * Contains the countries data, an array of objects indexed by country id
	 *
	 * @access private
	 * @static
	 * @since 3.8.14
	 *
	 * @var array
	 */
	private static $countries = null;

	/**
	 * Can array that maps from country isocode to country id
	 *
	 * @access private
	 * @static
	 * @since 3.8.14
	 *
	 * @var array
	*/
	private static $country_iso_code_map = array();

	/**
	 * Country names as key sorted in alpha order, data is country id
	 *
	 * @access private
	 * @static
	 * @since 3.8.14
	 *
	 * @var array
	 */
	private static $country_names = array();

	/**
	 * Returns an instance of the form with a particular ID
	 *
	 * @access public
	 * @static
	 * @since 3.8.10
	 *
	 * @param int $id Optional. Defaults to 0. The ID of the form
	 * @return WPSC_Checkout_Form
	 */
	public static function &get() {
		if ( ! self::$countries ) {
			self::$countries = new WPSC_Country_Region();
		}

		return self::$countries;
	}

	/**
	 * Constructor of an WPSC_Checkout_Form instance. Cannot be called publicly
	 *
	 * @access private
	 * @since 3.8.10
	 *
	 * @param string $id Optional. Defaults to 0.
	 */
	public function __construct() {
		if ( self::$countries == null ) {
			self::restore_myself();
		}

		if ( self::$countries == null ) {
			global $wpdb;

			$sql = 'SELECT * FROM `' . WPSC_TABLE_CURRENCY_LIST . '` WHERE `visible`= "1" ORDER BY country ASC';
			$country_data = $wpdb->get_results( $sql );

			// now countries is a list with the key being the integer country id, the value is the country data
			self::$countries = $wpdb->get_results( $sql, OBJECT_K );

			// build an array to map from iso code to country, while we do this get any region data for the country
			foreach ( self::$countries as $country_id => $country ) {

				self::$country_iso_code_map[$country->isocode] = intval( $country->id );
				self::$country_names[$country->country] = intval( $country->id );

				if ( $country->has_regions == '1' ) {
					$sql = 'SELECT * FROM `' . WPSC_TABLE_REGION_TAX . '` '
							. ' WHERE `country_id` = %d '
							. ' ORDER BY code ASC ';

					// put the regions list into our country object
					self::$countries[$country_id]->regions = $wpdb->get_results( $wpdb->prepare( $sql, $country_id, OBJECT_K ) );

					// take this opportunity to clean up any types that have been turned into text by the query
					self::$countries[$country_id]->id          = intval( self::$countries[$country_id]->id );
					self::$countries[$country_id]->has_regions = self::$countries[$country_id]->has_regions == '1';
					self::$countries[$country_id]->visible     = self::$countries[$country_id]->visible == '1';

					if ( ! empty( self::$countries[$country_id]->tax ) && is_number( self::$countries[$country_id]->tax ) ) {
						self::$countries[$country_id]->tax = floatval( self::$countries[$country_id]->tax );
					}
				}
			}

			self::save_myself();
		}
	}

	/**
	 * Returns a count of how many fields are in the checkout form
	 *
	 * @access public
	 * @since 3.8.10
	 *
	 * @param bool $exclude_heading Optional. Defaults to false. Whether to exclude heading
	 *                                        fields from the output
	 * @return array
	 */
	static function get_countries_count() {
		return count( self::get_countries() );
	}

	/**
	 * Clears the copy of the structured countries data we have cached
	 *
	 * @access public static
	 *
	 * @since 3.8.10
	 *
	 * @return none
	 */
	public static function clear_cache() {
		delete_transient( self::transient_name() );
	}

	/**
	 * Save the structured county data
	 *
	 * @access private
	 *
	 * @since 3.8.10
	 *
	 * @return none
	 */
	private function save_myself() {

		$mydata = array();
		$mydata['country_iso_code_map'] = self::$country_iso_code_map;
		$mydata['countries']            = self::$countries;
		$mydata['country_names']        = self::$country_names;

		set_transient( self::transient_name(), $mydata, WEEK_IN_SECONDS );
	}

	/**
	 * Restore the structured country data from the cache int the class
	 *
	 * @access private static
	 *
	 * @since 3.8.10
	 *
	 * @return none
	 */
	private function restore_myself() {

		$mydata = get_transient(  self::transient_name() );

		self::$country_iso_code_map = $mydata['country_iso_code_map'];
		self::$countries            = $mydata['countries'];
		self::$country_names        = $mydata['country_names'];

		return $this;
	}

	/**
	 * The identifier for the tranient used to cache country data
	 *
	 * @access public static
	 *
	 * @since 3.8.10
	 *
	 * @return none
	 */

	private static function transient_name() {
		return strtolower( __CLASS__ . '-' . WPSC_DB_VERSION );
	}

	/**
	 * Confirm the class is initialized
	 *
	 * @access private static
	 *
	 * @since 3.8.14
	 *
	 * @return none
	 */
	private static function confirmed_initialization() {
		if ( self::$countries == null ) {
			$an_instance = new WPSC_Country_Region();
		}

		return (self::$countries != null);
	}


}

// a little tiny test stub
if ( true ) {
	function testit() {

		$x = WPSC_Country_Region::region_count( 'US' );
		//error_log( 'US static has ' . $x );

		$x = WPSC_Country_Region::region_count( '136' );
		//error_log( '136 static has ' . $x );

	}

	add_action( 'wpsc_setup_customer', 'testit' );
}