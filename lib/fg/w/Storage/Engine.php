<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Storage;



/**
 *
 *
 *	@package fg.w.Storage
 */

interface Engine {

	/**
	 *
	 */

	public function has( $key );



	/**
	 *
	 */

	public function read( $key, $default = null );



	/**
	 *
	 */

	public function write( $key, $value );



	/**
	 *
	 */

	public function delete( $key );



	/**
	 *
	 */

	public function clear( );

}
