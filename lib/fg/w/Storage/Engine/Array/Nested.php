<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Storage\Engine\Array;



/**
 *	Stores a collection of string indexed values.
 *
 *	@package fg.w.Storage.Engine.Array
 */

class Array implements \fg\w\Storage\Engine\Array {

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

		return array_key_exists( $key, $data );
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

		if ( array_key_exists( $key, $data )) {
			return $data[ $key ];
		}

		return $default;
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

		if ( array_key_exists( $key, $data )) {
			unset( $data[ $key ]);
		}
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
}
