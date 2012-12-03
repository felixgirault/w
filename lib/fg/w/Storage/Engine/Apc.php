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

class Apc implements \fg\w\Storage\Engine {

	/**
	 *	@var integer
	 */

	protected $_ttl = 0;



	/**
	 *
	 */

	public function __construct( $ttl = 0 ) {

		$this->_ttl = $ttl;
	}



	/**
	 *
	 */

	public function has( $key ) {

		return apc_exists( $key );
	}



	/**
	 *
	 */

	public function read( $key, $default = null ) {

		$value = apc_fetch( $key, $success );

		return $success
			? $value
			: $default;
	}



	/**
	 *
	 */

	public function write( $key, $value ) {

		apc_store( $key, $value, $this->_ttl );
	}



	/**
	 *
	 */

	public function delete( $key ) {

		apc_delete( $key );
	}



	/**
	 *
	 */

	public function clear( ) {

		apc_clear_cache( );
	}
}
