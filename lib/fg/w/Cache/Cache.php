<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Cache;



/**
 *
 *
 *	@package fg.w.Pattern
 */

class Cache {

	/**
	 *
	 */

	protected $_Engine = null;



	/**
	 *
	 */

	public function __construct( ) {

	}



	/**
	 *
	 */

	public function read( $key, $default = null ) {

		try {
			return $this->_Engine->read( $key );
		} catch ( ) {
			// log
		}

		return $default;
	}



	/**
	 *
	 */

	public function write( $key, $value ) {

		$this->_Engine->write( $key, $value );
	}
}
