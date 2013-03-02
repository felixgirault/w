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

		return array_key_exists( $key, $this->_data );
	}



	/**
	 *	Sets the value of the given key.
	 *
	 *	@param string $key A key or a path identifying the value.
	 *	@param mixed $value The value to set.
	 */

	public function write( $key, $value ) {

		$this->_data[ $key ] = $value;
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

		return $this->has( $key )
			? $this->_data[ $key ]
			: $default;
	}



	/**
	 *	Deletes the value of the given key.
	 *
	 *	@param $key A key or a path identifying the value.
	 */

	public function delete( $key ) {

		if ( $this->has( $key )) {
			unset( $this->_data[ $key ]);
		}
	}
}
