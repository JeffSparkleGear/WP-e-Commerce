<?php

/*
 * This WPeC geography module provides
 *
 * The WPSC_Geography is a WPeC class used to provide easy access to country, region
 * and currency information for all of WPeC an any extensions. Because this data is
 * accessed a lot throughout WPeC it is designed to be quick and avoid accessing the database.
 *
 * How does it work?
 *  This class uses the static currency and region information distributed with WPeC to create an
 *  object that is optimized for access.  A copy of this object is cached.  When WPeC initialized
 *  this cached object is retrieved and used to service any request for geographical data.
 *
 * How is this data refreshed if it is cached?
 *  If an administrator changes country data in the WPeC admin tool the object will be rebuilt. If
 *  WPeC is upgraded the object will be rebuilt. And, because the object is stored as a transient, any
 *  action that would refresh the WordPress object cache would cause the object
 *
 * Where is the global so I can access this data?
 *  I'm not telling! (just kidding) ... There isn't one because I hate globals (and I want you to hate globals also).
 *  You access geography data through the static methods available in WPSC_Geography, or by instantiating
 *  objects of type WPSC_Nation and WPSC_Region.
 *
 * Why is there a WPSC_Nation class not WPSC_Country?
 *  At the time this module was created there was already a WPSC_Country class.  WPSC_Country was only used in a
 *  couple of places, and the module is on the fast track to being deprecated.
 *
 * What about the database?
 *  Can you identify the film this quote comes from? ... Forget about Dave. For our immediate purposes, there is no Dave. Dave does not exist.
 *
 * Why is that important?
 *  Forget about database. For our immediate purposes, there is no database. database does not exist.
 *  If you use the functionality in this module it is unlikely you will need to find the data storage for the raw
 *  geography data.
 *
 * Before this class existed the direct queries to the database where really simple. Did creating this
 * module really help?
 *  uhhh, Yes. The checkout page was used as a benchmark.  When this class was there were almost 200 fewer queries
 *  to the database on just that page. Besides that there was a lot of duplicated code scattered about WPeC do get
 *  the data from the database. Much of that code had subtle variations that made it hard to maintain.
 *
 * Any other benefits to this module over direct to database
 *  Going direct the database prevented us from improving the mechanism used to store and distribute country data and
 *  updates without changing a lot of code.  Now all the database access is centralized we can make some improvements
 *  when we have time
 *
 *
 * The implementation consists of three class
 *
 * WPSC_Nation      Get anything about a single country you might want to know
 * WPSC_Region      Get anything about a single region you might want to know
 * WPSC_Geography   Get lists of countries, convert key fields to unique ids, and other useful functions,
 * 						Also abstracts data storage mechanism from
 *
 *
 *
 *
 */



/**
 * description
 *
 * @access public
 *
 * @since 3.9
 *
 * @param
 *
 * @return void
 */
class WPSC_Region {

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function __construct( $country_id_or_isocode, $region_id_or_code ) {

		$country_id = WPSC_Geography::country_id( $country_id_or_isocode );
		$region_id = WPSC_Geography::region_id( $country_id_or_isocode, $region_id_or_code );

		if ( $country_id && $region_id ) {
			$this->_country_name = WPSC_Geography::country( $country_id_or_isocode )->name;
			$region = WPSC_Geography::country( $country_id_or_isocode, $region_id_or_code );

			$this->_copy_properties_from_stdclass( $region );
		}
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function name() {
		return $this->_name;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function id() {
		return $this->_name;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function code() {
		return $this->_code;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function tax() {
		return $this->_tax;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function country_id() {
		return $this->_country_id;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function _copy_properties_from_stdclass( $region ) {
		$this->_country_id	= $region->country_id;
		$this->_name 		= $region->name;
		$this->_code 		= $region->code;
		$this->_id 			= $region->id;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	private $_id 			= null;
	private $_country_id 	= null;
	private $_name 			= null;
	private $_code 			= null;
	private $_tax 			= 0;
}

/**
 * description
 *
 * @access public
 *
 * @since 3.9
 *
 * @param
 *
 * @return void
 */
class WPSC_Nation {

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function __construct( $country_id_or_isocode ) {

		$country_id = WPSC_Geography::country_id( $country_id_or_isocode );
		if ( $country_id ) {
			$country = WPSC_Geography::country( $country_id_or_isocode );
			$this->_copy_properties_from_stdclass( $country );
		}
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function name() {
		return $this->_name;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function id() {
		return $this->_id;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function isocode() {
		return $this->_isocode;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function currency_name() {
		return $this->_currency_name;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function currency_symbol() {
		return $this->_currency_symbol;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function currency_symbol_html() {
		return $this->_currency_symbol_html;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function currency_code() {
		return $this->_currency_code;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function has_regions() {
		return $this->_has_regions;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function tax() {
		return $this->_tax;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function continent() {
		return $this->_continent;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function visible() {
		return $this->_visible;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function region( $region_id_or_code ) {
		return new WPSC_Region( $this->_id, $region_id_or_code );
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	public function _copy_data_from_stdclass( $region ) {
		$this->_id 						= $country->id;
		$this->_name 					= $country->country;
		$this->_isocode 				= $country->isocode;
		$this->_currency_name			= $country->currency;
		$this->_currency_symbol 		= $country->symbol;
		$this->_currency_symbol_html	= $country->symbol_html;
		$this->_currency_code			= $country->code;
		$this->_has_regions 			= $country->has_regions;
		$this->_tax 					= $country->tax;
		$this->_continent 				= $country->continent;
		$this->_visible 				= $country->visible;
	}

	/**
	 * description
	 *
	 * @access public
	 *
	 * @since 3.9
	 *
	 * @param
	 *
	 * @return void
	 */
	private $_id 					= null;
	private $_name 					= null;
	private $_isocode 				= null;
	private $_currency_name 		= '';
	private $_currency_symbol 		= '';
	private $_currency_symbol_html 	= '';
	private $_code 					= '';
	private $_has_regions 			= false;
	private $_tax 					= '';
	private $_continent 			= '';
	private $_visible 				= true;

}

/**
 * description
 *
 * @access public
 *
 * @since 3.9
 *
 * @param
 *
 * @return void
 */
class WPSC_Geography {


	/**
	 * Change an country ISO code into a country id, if a country id is passed it is returned intact
	 *
	 * @access public
	 * @static
	 * @since 3.8.14
	 *
	 * @param int | string country being check, if noon-numeric country is treated as an isocode, number is the country id
	 */
	public static function country_id( $country_id_or_isocode ) {
		$country_id = false;

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		if ( is_numeric( $country_id_or_isocode ) ) {
			$country_id = intval( $country_id_or_isocode );
		} else {
			if ( isset( self::$country_iso_code_map[$country_id_or_isocode] ) ) {
				$country_id = self::$country_iso_code_map[$country_id_or_isocode];
			}
		}

		return $country_id;
	}

	/**
	 * Change an region code into a region id, if a region id is passed it is returned intact
	 *
	 * @access public
	 * @static
	 * @since 3.8.14
	 *
	 * @param int | string country being check, if noon-numeric country is treated as an isocode, number is the country id
	 */
	public static function region_id( $country_id_or_isocode, $region_id_or_code ) {
		$country_id = false;

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$region_id = self::country_id( $country_id_or_isocode );

		if ( is_numeric( $region_id_or_code ) ) {
			$region_id = intval( $region_id_or_code );
		} else {
			if ( isset( self::$countries[$country_id]->region_id_to_region_code_map[$region_id_or_code] ) ) {
				$region_id = self::$country_iso_code_map[$region_id_or_code];
			}
		}

		return $region_id;
	}


	/**
	 * How many regions does the country have
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string country being check, if non-numeric country is treated as an isocode, number is the country id
	 */
	public static function region( $country_id_or_isocode, $region_id_or_code ) {

		if ( ! self::confirmed_initialization() ) {
			return null;
		}

		$country_id = self::country_id( $country_id_or_isocode );
		$region_id = self::country_id( $region_id_or_code );

		if ( $country_id && $region_id ) {
			$region = self::$countries[$country_id]->regions[$region_id];
		} else {
			$region = null;
		}

		return $region;
	}

	/**
	 * The country information
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string $country_id_or_isocode    country being check, if non-numeric country is treated as an isocode, number is the country id
	 * @param boolean return the result as an array, default is to return the result as an object
	 *
	 * @return object|array country information
	 */
	public static function country( $country_id_or_isocode, $as_array = false ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$country_id = self::country_id( $country_id_or_isocode );

		$country = null;

		if ( $country_id ) {
			if ( isset( self::$countries[$country_id] )	) {
				$country = self::$countries[$country_id];
			}
		}

		if ( $as_array ) {
			$json  = json_encode( $country );
			$country = json_decode( $json, true );
		}

		return $country;
	}

	/**
	 * The currency for a country
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string $country_id_or_isocode    country being check, if non-numeric country is treated as an isocode, number is the country id
	 *
	 * @return string  currency code for the specified country
	 */
	public static function currency_code( $country_id_or_isocode ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$country_id = self::country_id( $country_id_or_isocode );

		$currency_code = '';

		if ( $country_id ) {
			$currency_code = self::$countries[$country_id]->code;
		}

		return $currency_code;
	}

	/**
	 * The currency symbol for a country
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string $country_id_or_isocode    country being check, if non-numeric country is treated as an isocode, number is the country id
	 *
	 * @return string  currency symbol for the specified country
	 */
	public static function currency_symbol( $country_id_or_isocode ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$country_id = self::country_id( $country_id_or_isocode );

		$currency_symbol = '';

		if ( $country_id ) {
			$currency_symbol = self::$countries[$country_id]->symbol;
		}

		return $currency_symbol;
	}


	/**
	 * The currency symbol for a country
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string $country_id_or_isocode    country being check, if non-numeric country is treated as an isocode, number is the country id
	 *
	 * @return string  currency symbol for the specified country
	 */
	public static function continent( $country_id_or_isocode ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$continent = self::country_id( $country_id_or_isocode );

		$currency_symbol = '';

		if ( $continent ) {
			$continent = self::$countries[$country_id]->continent;
		}

		return $continent;
	}

	/**
	 * The currency_code
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string $country_id_or_isocode    country being check, if non-numeric country is treated as an isocode, number is the country id
	 *
	 * @return string  currency symbol html for the specified country
	 */
	public static function currency_symbol_html( $country_id_or_isocode ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$country_id = self::country_id( $country_id_or_isocode );

		$currency_symbol = '';

		if ( $country_id ) {
			$currency_symbol = self::$countries[$country_id]->symbol_html;
		}

		return $currency_symbol;
	}

	/**
	 * The currency_code
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string $country_id_or_isocode    country being check, if non-numeric country is treated as an isocode, number is the country id
	 *
	 * @return string  currency symbol html for the specified country
	 */
	public static function currency_data( $country_id_or_isocode, $as_array = false ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$country_id = self::country_id( $country_id_or_isocode );

		$currency_data = new stdClass();

		if ( $country_id ) {
			$currency_data->code           = self::$countries[$country_id]->code;
			$currency_data->symbol         = self::$countries[$country_id]->symbol;
			$currency_data->symbol_html    = self::$countries[$country_id]->symbol_html;
		}

		if ( $as_array ) {
			$json  = json_encode( $currency_data );
			$currency_data = json_decode( $json, true );
		}


		return $currency_data;
	}


	/**
	 * The regions for a country
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string country being check, if noon-numeric country is treated as an isocode, number is the country id
	 *
	 * @return array of region objects index by region id
	 */
	public static function regions( $country_id_or_isocode, $as_array = false ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$country_id = self::country_id( $country_id_or_isocode );

		$regions = array();

		if ( $country_id ) {
			if ( self::$countries[$country_id]->has_regions
				&& property_exists(  self::$countries[$country_id], 'regions' )
					&& is_array(  self::$countries[$country_id]->regions ) ) {
				$regions = self::$countries[$country_id]->regions;
			}
		}

		if ( $as_array ) {
			$json  = json_encode( $regions );
			$regions = json_decode( $json, true );
		}

		return $regions;
	}

	/**
	 * The Countries
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param boolean return the results as an associative array rather than an object
	 *
	 * @return array of region objects index by region id
	 */
	public static function countries( $as_array = false ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$countries = self::$countries;

		if ( $as_array ) {
			$json  = json_encode( $countries );
			$countries = json_decode( $json, true );
		}

		return $countries;
	}

	/**
	 * How many regions does the country have
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string country being check, if noon-numeric country is treated as an isocode, number is the country id
	 *
	 * @return int count of regions in a country, if region is invalid 0 is returned
	 */
	public static function region_count( $country_id_or_isocode ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$region_count = 0;

		if ( $country_id = self::country_id( $country_id_or_isocode ) ) {
			if ( self::$countries[$country_id]->has_regions
				&& property_exists(  self::$countries[$country_id], 'regions' )
					&& is_array(  self::$countries[$country_id]->regions )
			) {
				$region_count = count( self::$countries[$country_id]->regions );
			}
		}

		return $region_count;
	}


	/**
	 * Does the country have regions
	 *
	 * @access public
	 * @since 3.8.14
	 *
	 * @param int | string country being check, if noon-numeric country is treated as an isocode, number is the country id
	 *
	 * @return true if th country has regions, false otherwise
	 */
	public static function country_has_regions( $country_id_or_isocode ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$has_regions = false;

		if ( $country_id = self::country_id( $country_id_or_isocode ) ) {
			if ( property_exists( self::$countries[$country_id], 'regions' ) ) {
				if ( count( self::$countries[$country_id]->regions ) ) {
					$has_regions = self::$countries[$country_id]->has_regions && count( self::$countries[$country_id]->regions );
				}
			}
		}

		return $has_regions;
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
	 * Get the list of currencies,
	 *
	 * @access private
	 * @static
	 * @since 3.8.14
	 *
	 * @return array   country list with index as country, value as name, sorted by country name
	 */
	public static function currencies( $as_array = false ) {

		if ( ! self::confirmed_initialization() ) {
			return 0;
		}

		$currencies = self::$currencies;

		if ( $as_array ) {
			$json  = json_encode( $currencies );
			$currencies = json_decode( $json, true );
		}

		// we have the return value in our country name to id map, all we have to do is swap the keys with the values
		return $currencies;
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
	 * An array that maps from country isocode to country id
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
	 * Array of unique known currencies, indexed by corrency code
	 *
	 * @access private
	 * @static
	 * @since 3.8.14
	 *
	 * @var array
	 */
	private static $currencies = array();

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
			self::$countries = new WPSC_Geography();
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

			// now countries is a list with the key being the integer country id, the value is the country data
			$sql = 'SELECT id,
						country, isocode, currency, symbol, symbol_html, code, has_regions, tax, continent, visible
					FROM `' . WPSC_TABLE_CURRENCY_LIST . '` WHERE `visible`= "1" ORDER BY id ASC';

			self::$countries = $wpdb->get_results( $sql, OBJECT_K );

			// build an array to map from iso code to country, while we do this get any region data for the country
			foreach ( self::$countries as $country_id => $country ) {

				// take this opportunity to clean up any types that have been turned into text by the query
				self::$countries[$country_id]->id          = $country->id          = intval( self::$countries[$country_id]->id );
				self::$countries[$country_id]->has_regions = $country->has_regions = self::$countries[$country_id]->has_regions == '1';
				self::$countries[$country_id]->visible     = $country->visible     = self::$countries[$country_id]->visible == '1';

				if ( ! empty( self::$countries[$country_id]->tax ) && ( is_int( self::$countries[$country_id]->tax ) ) || is_float( self::$countries[$country_id]->tax ) ) {
					self::$countries[$country_id]->tax = $country->tax = floatval( self::$countries[$country_id]->tax );
				}

				self::$country_iso_code_map[$country->isocode] = intval( $country->id );
				self::$country_names[$country->country] = intval( $country->id );

				if ( $country->has_regions ) {
					$sql = 'SELECT code, country_id, name, tax, id FROM `' . WPSC_TABLE_REGION_TAX . '` '
							. ' WHERE `country_id` = %d '
							. ' ORDER BY code ASC ';

					// put the regions list into our country object
					self::$countries[$country_id]->regions = $wpdb->get_results( $wpdb->prepare( $sql, $country_id ) , OBJECT_K );

					self::$countries[$country_id]->region_id_to_region_code_map = array();

					// any properties that came in as text that should be numbers or boolean get adjusted here, we also build
					// an array to map from region code to region id
					foreach ( self::$countries[$country_id]->regions as $region_code => $region ) {
						$region->id         = intval( $region->id );
						$region->country_id = intval( $region->country_id );
						$region->tax        = floatval( $region->tax );

						self::$countries[$country_id]->region_id_to_region_code_map[$region->id] = $region->code;
					}

					ksort( self::$countries[$country_id]->region_id_to_region_code_map );
				}
			}

			// now countries is a list with the key being the integer country id, the value is the country data

			// build a global active currency list
			$sql = 'SELECT DISTINCT code, symbol, symbol_html, currency FROM `' . WPSC_TABLE_CURRENCY_LIST . '` ORDER BY code ASC';
			self::$currencies = $wpdb->get_results( $sql, OBJECT_K );

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
		$mydata['country_iso_code_map']         = self::$country_iso_code_map;
		$mydata['countries']                    = self::$countries;
		$mydata['country_names']                = self::$country_names;
		$mydata['currencies']                   = self::$currencies;

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

		$have_data = false;

		if ( count( $mydata ) == 4 ) {

			if (
				is_array( $mydata['country_iso_code_map'] )
					&& is_array( $mydata['countries'] )
						&& is_array( $mydata['country_names'] )
							&& is_array( $mydata['currencies'] )
				) {
					self::$country_iso_code_map         = $mydata['country_iso_code_map'];
					self::$countries                    = $mydata['countries'];
					self::$country_names                = $mydata['country_names'];
					self::$currencies                   = $mydata['currencies'];

					$have_data = true;
			}
		}

		if ( ! $have_data && ( $mydata === false ) ) {
			self::clear_cache();
		}

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
			$an_instance = new WPSC_Geography();
		}

		return (self::$countries != null);
	}
}

// a little tiny test stub
if ( true ) {
	function testit() {

		WPSC_Geography::clear_cache();

		$x = WPSC_Geography::region_count( 'US' );
		//error_log( 'US static has ' . $x );

		$x = WPSC_Geography::region_count( '136' );
		//error_log( '136 static has ' . $x );

		$us = new WPSC_Nation( 'US' );

		$ma = new WPSC_Nation( 'US', 'MA' );

		//error_log( 'testit done' );

	}

	add_action( 'wpsc_setup_customer', 'testit' );
}

