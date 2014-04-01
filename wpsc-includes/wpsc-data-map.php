<?php


/**
 * A class that will maintain a map of keys to values, and persist it across page sessions.
 * Users of this class should treat it like a transient, it can vaporize and not be
 * available until reconstructed
 *
 * @access public
 *
 * @since 3.8.14
 *
 * @param a map name to uniquely identify this map so it can be saved and restored
 *
 * @return object WPSC_Country
 */
class WPSC_Data_Map {

	/**
	 * Create the map
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @param string  		a map name to uniquely identify this map so it can be saved and restored
	 * @param string|array  a callback function to re-generate the map if it can't be reloaded when it is neaded
	 *
	 */
	public function __construct( $map_name, $map_callback = null ) {
		$this->_map_name 		= $map_name;
		$this->_map_callback 	= $map_callback;
		add_action( 'shutdown', array( &$this, '_save_map' ) );
	}

	/**
	 * Clear the cached map
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return string  a map name to uniquely identify this map so it can be saved and restored
	 */
	public function clear() {
		if ( ! empty( $this->_map_name ) ) {
			delete_transient( $this->_map_name );
			$this_map_data = null;
		}
	}

	/**
	 * Get the value associated wit ha key from the map, or null on failure
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return string  a map name to uniquely identify this map so it can be saved and restored
	 */
	public function value( $key ) {
		if ( $this->confirm_data_ready() ) {
			if ( isset( $this->_map_data[$key] ) ) {
				return $this->_map_data[$key];
			}
		}

		return null;
	}

	/**
	 * Get the value associated wit ha key from the map, or null on failure
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return string  a map name to uniquely identify this map so it can be saved and restored
	 */
	public function map( $key, $value ) {
		if ( $this->confirm_data_ready() ) {
			if ( ! (isset( $this->_map_data[$key] )  && ( $this->_map_data[$key] == $value ) ) ) {
				$this->_map_data[$key] = $value;
				$this->_dirty = true;
			}
		}

		return false;
	}

	/**
	 * Save the map
	 *
	 * @access private
	 *
	 * @since 3.8.14
	 *
	 * @return string  a map name to uniquely identify this map so it can be saved and restored
	 */
	public function _save_map() {
		if ( $this->_dirty ) {
			ksort( $this->_map_data );
			set_transient( $this->_map_name, $this->_map_data, WEEK_IN_SECONDS );
			$this->_dirty = false;
		}

	}

	/**
	 * Make sure the data is available
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return string  a map name to uniquely identify this map so it can be saved and restored
	 */
	private function confirm_data_ready() {
		if ( ! is_array( $this->_map_data ) ) {
			$this->_map_data = get_transient( $this->_map_name );
			if ( ! is_array( $this->_map_data ) ) {
				$this->_map_data = array();
				$this->_dirty = true;
			}
		}

		return (  is_array( $this->_map_data ) );

	}


	/**
	 * Private properties for this class
	 *
	 * @access private
	 *
	 * @since 3.8.14
	 *
	 */
	private $_map_name 		= null;
	private $_map_callback 	= null;
	private $_map_data 		= null;
	private $_dirty    		= false;


}