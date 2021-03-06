<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Storage\Engine;



/**
 *	Stores a collection of string indexed values.
 *
 *	@package fg.w.Storage.Engine
 */

abstract class Array implements \fg\w\Storage\Engine {

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

	public function __construct( array &$data = array( )) {

		$this->_data =& $data;
	}



	/**
	 *	Returns if a value exists for the given key.
	 *
	 *	@param string $key A key or a path identifying the value.
	 *	@return boolean Whether a value exists or not.
	 */

	abstract public function has( $key );



	/**
	 *	Sets the value of the given key.
	 *
	 *	@param string $key A key or a path identifying the value.
	 *	@param mixed $value The value to set.
	 */

	abstract public function write( $key, $value );



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

	abstract public function read( $key, $default = null );



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

	abstract public function delete( $key );



	/**
	 *
	 */

	public function clear( ) {

		$this->_data = array( );
	}
}
