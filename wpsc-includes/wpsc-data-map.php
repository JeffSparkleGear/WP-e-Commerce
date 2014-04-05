<?php

/**
 * WPSC_Data_Map
 * A class that will maintain a map of keys to values, and persist it across page sessions.
 * Users of this class should treat it like a transient, it can vaporize and not be
 * available until reconstructed.  The contents of the map can be manually cleared using the
 * clear method.
 *
 * This class has these advantages over using an array in the implementation of business logic:
 *  - caching is completely transparent you don't need to
 *
 *  - can return a value from a list of values based on a unique identifier
 *
 *  - will retain its list of values throughout a transactions execution without having
 *    to go back to a database
 *
 *  - is smart enough restore its list of values from a cached copy of itself only if it
 *    is necessary, and without a client needing to initiate the save
 *
 *  - can automatically save itself when appropriate, and without a client object needing
 *    to initiate the save operation
 *
 *  - will automatically recreate itself should it be the case that  the cached copy its
 *    data was no longer available
 *
 * @access public
 *
 * @since 3.8.14
 *
 */

class WPSC_Data_Map {

	/**
	 * Create the map
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @param string  		$saved_map_unique_name 		a map name to uniquely identify this map so it can be saved and restored
	 * 													if empty the map will not be save
	 * @param string|array  a callback function to re-generate the map if it can't be reloaded when it is needed
	 *
	 */
	public function __construct( $saved_map_unique_name = '', $create_map_callback = null ) {

		$this->_map_name 		= $saved_map_unique_name;
		$this->_map_callback 	= $map_callback;

		// if our map is names it means we want to save the map for use some time in the future
		if ( ! empty( $this->_map_name ) ) {
			add_action( 'shutdown', array( &$this, '_save_map' ) );
		}
	}

	/**
	 * get an array filled with all of the items in the map
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return array
	 */
	public function data() {
		if ( is_array( $this->_map_data ) ) {
			return array_values( $this->_map_data );
		} else {
			return array();
		}
	}

	/**
	 * get an array filled with all of the keys in the map
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return array
	 */
	public function keys() {
		if ( is_array( $this->_map_data ) ) {
			return array_keys( $this->_map_data );
		} else {
			return array();
		}
	}

	/**
	 * Count of items in the map
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return int
	 */
	public function count() {
		$count = 0;

		if ( is_array( $this->_map_data ) ) {
			$count = count( $this->_map_data );
		}

		return $count;
	}

	/**
	 * Clear the cached map
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return self reference to support method chaining
	 */
	public function clear() {
		if ( ! empty( $this->_map_name ) ) {
			delete_transient( $this->_map_name );
		}

		$this->_map_data = null;

		return $this;
	}

	/**
	 * Get the value associated wit ha key from the map, or null on failure
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @param string|int  $key 			for which the value will be retrieved
	 * @param any (including callable)  $default 	what to return if the key is not found
	 *
	 * @return string  the value from the data map if it is there, otherwise the value of the default parameter, or null
	 */
	public function value( $key, $default = null ) {
		if ( $this->_confirm_data_ready() ) {
			if ( isset( $this->_map_data[$key] ) ) {
				$value = $this->_map_data[$key];
			} else {
				if ( $default === null ) {
					$value = null;
				} elseif ( is_callable( $default ) ) {
					$value = call_user_func( $default );
				} else {
					$value = $default;
				}
			}
		}

		return $value;
	}

	/**
	 * Get the value associated with a key from the map, or null on failure
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @param string  	$key_or_array_of_key_values		the key value for the map, or an array of key value pairs
	 * @param varied	$value 							to store in the map, ignored if first parameter is an array
	 *
	 * @return self reference to support method chaining
	 */
	public function map( $key_or_array_of_key_values, $value = null ) {

		if ( $this->_confirm_data_ready() ) {
			// if we got a single value add it to the map
			if ( ! is_array( $key_or_array_of_key_values ) ) {
				$key = $key_or_array_of_key_values;
				if ( ! (isset( $this->_map_data[$key] )  && ( $this->_map_data[$key] == $value ) ) ) {
					$this->_map_data[$key] = $value;
					$this->_dirty = true;
				}
			} else {
				// add map entry for each element
				foreach ( $key_or_array_of_key_values as $key => $value ) {
					$this->map( $key, $value );
				}
			}
		}

		return $this;
	}


	/**
	 * Save the map- if this map has been given a name it means we will save it as a transient when
	 *               requested or when we shutdown
	 *
	 * @access private
	 *
	 * @since 3.8.14
	 *
	 * @return self reference to support method chaining
	 */
	public function _save_map() {
		if ( $this->_dirty ) {

			// we sort the data before storing it, just to be neat
			ksort( $this->_map_data );

			// if the map is named we will save it for next time, unless it is empty, we give an
			// expiration so that transient storage mechanisms can destroy the map if space is needed
			if ( ! empty ( $this->_map_name ) ) {
				if ( ! empty( $this->_map_data ) ) {
					set_transient( $this->_map_name, $this->_map_data, 13 * WEEK_IN_SECONDS );
				} else {
					delete_transient( $this->_map_name );
				}
			}

			$this->_dirty = false;
		}

		return $this;
	}

	/**
	 * Make sure the data is available
	 *
	 * @access public
	 *
	 * @since 3.8.14
	 *
	 * @return boolean   true if the map is ready and has leaded any saved data from the transient store
	 */
	private function _confirm_data_ready() {
		if ( ! is_array( $this->_map_data ) ) {

			// if this is a named map we can try to restore it from the transient store
			if ( ! empty ( $this->_map_name ) ) {
				$this->_map_data = get_transient( $this->_map_name );
			}

			// if we still don't have a valid map and there is a constructor callback use it
			if ( ! is_array( $this->_map_data ) && ! empty( $this->_map_callback ) && is_callable( $this->_map_callback ) ) {

				$this->_map_data = array();
				call_user_func( $this->_map_callback , $this );
				if ( ! is_array( $this->_map_data ) ) {
					$this->_map_data = array();
					$this->_dirty = true;
				}
			}

			// if we still don't have valid map data create an empty array
			if ( ! is_array( $this->_map_data ) ) {
				$this->_map_data = array();
			}

			// we have not soiled our data, note that
			$this->_dirty = false;
		}

		return (  is_array( $this->_map_data ) );

	}

	/**
	 * is the data in the map dirty and in need of saving?
	 *
	 * @access private
	 *
	 * @since 3.8.14
	 *
	 * @return boolean  true if dirty, false if no modifications have been made
	 *
	 */
	public function dirty() {
		return $this->_dirty;
	}

	/**
	 * Private properties for this class, some are declared as public so that objects of this class
	 * can be easily serialized, not to provide access to the outside world.
	 *
	 * @access private
	 *
	 * @since 3.8.14
	 *
	 */
	public $_map_name 		= null;
	public $_map_callback 	= null;
	public $_map_data 		= null;
	private $_dirty    		= false;
}