<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Storage\Engine;



/**
 *
 *
 *	@package fg.w.Storage.Engine
 */

class File implements \fg\w\Storage\Engine {

	/**
	 *
	 */

	protected $_File = null;



	/**
	 *
	 *
	 *	@throws RuntimeException if the file could not be loaded.
	 */

	public function __construct( $fileName ) {

		$this->_File = new \SplFileObject( $fileName );
	}



	/**
	 *
	 */

	public function has( $key ) {

	}



	/**
	 *
	 */

	public function read( $key, $default = null ) {

	}



	/**
	 *
	 */

	public function write( $key, $value ) {

	}



	/**
	 *
	 */

	public function delete( $key ) {

	}



	/**
	 *
	 */

	public function clear( ) {

	}
}
