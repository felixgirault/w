<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Storage;



/**
 *	Stores a collection of string indexed values.
 *
 *	@package fg.w.Storage
 */

class Store {

	/**
	 *	Internal data.
	 *
	 *	@param array
	 */

	protected $_data = array( );



	/**
	 *	Populates the store with the given data.
	 *
	 *	@param array $data Initial data.
	 */

	public function __construct( array $data = array( )) {

		$this->_data = $data;
	}



	/**
	 *	Returns if the given string is a path.
	 *
	 *	@param string $string The string to test.
	 *	@param boolean Whether the string is a path or not.
	 */

	protected function _isPath( $string ) {

		return ( strpos( $string, '.' ) !== false );
	}



	/**
	 *	Returns if a value exists for the given key.
	 *
	 *	@param string $key A key or a path identifying the value.
	 *	@return boolean Whether a value exists or not.
	 */

	public function has( $key ) {

		$data =& $this->_data;

		if ( $this->_isPath( $key )) {
			$sections = explode( '.', $key );
			$key = array_pop( $sections );

			foreach ( $sections as $section ) {
				if ( isset( $data[ $section ]) && is_array( $data[ $section ])) {
					$data =& $data[ $section ];
				} else {
					return false;
				}
			}
		}

		return isset( $data[ $key ]);
	}



	/**
	 *	Sets the value of the given key.
	 *
	 *	@param string $key A key or a path identifying the value.
	 *	@param mixed $value The value to set.
	 */

	public function write( $key, $value ) {

		$data =& $this->_data;

		if ( $this->_isPath( $key )) {
			$sections = explode( '.', $key );
			$key = array_pop( $sections );

			foreach ( $sections as $section ) {
				if ( !isset( $data[ $section ]) || !is_array( $data[ $section ])) {
					$data[ $section ] = array( );
				}

				$data = &$data[ $section ];
			}
		}

		$data[ $key ] = $value;
	}



	/**
	 *	Sets all the internal data.
	 *
	 *	@param array $data The data to set.
	 */

	public function writeAll( array $data ) {

		$this->_data = $data;
	}



	/**
	 *	Returns the value of the given key, or a default value if it does not
	 *	exists.
	 *
	 *	@param string $key A key or a path identifying the value.
	 *	@param mixed $default A default value.
	 *	@return mixed The value of the given key, or the default value.
	 */

	public function read( $key, $default = null ) {

		$data =& $this->_data;

		if ( $this->_isPath( $key )) {
			$sections = explode( '.', $key );
			$key = array_pop( $sections );

			foreach ( $sections as $section ) {
				if ( isset( $data[ $section ]) && is_array( $data[ $section ])) {
					$data =& $data[ $section ];
				} else {
					return $default;
				}
			}
		}

		if ( isset( $data[ $key ])) {
			return $data[ $key ];
		}

		return $default;
	}



	/**
	 *	Returns all the internal data.
	 *
	 *	@return array Data.
	 */

	public function readAll( ) {

		return $this->_data;
	}



	/**
	 *	Deletes the value of the given key.
	 *
	 *	@param $key A key or a path identifying the value.
	 */

	public function delete( $key ) {

		$data =& $this->_data;

		if ( $this->_isPath( $key )) {
			$sections = explode( '.', $key );
			$key = array_pop( $sections );

			foreach ( $sections as $section ) {
				if ( !isset( $data[ $section ]) || !is_array( $data[ $section ])) {
					$data[ $section ] = array( );
				}

				$data = &$data[ $section ];
			}
		}

		if ( isset( $data[ $key ])) {
			unset( $data[ $key ]);
		}
	}
}
