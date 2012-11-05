<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;



/**
 *	Makes every class using the trait a singleton.
 *
 *	@see http://stackoverflow.com/a/7105008
 *	@package fg.w.Pattern
 */

trait Singleton {

	/**
	 *	Singleton instance.
	 *
	 *	@var Singleton
	 */

	protected static $_Instance = null;



	/**
	 *	Returns a singleton instance of the class.
	 *
	 *	@return Singleton Singleton instance
	 */

	final public static function instance( ) {

		if ( static::$_Instance === null ) {
			static::$_Instance = new static;
		}

		return static::$_Instance;
	}



	/**
	 *
	 */

	final private function __construct( ) {

		$this->_initialize( );
	}



	/**
	 *	Prevents copy.
	 */

	final private function __clone( ) { }



	/**
	 *	Prevents serialization.
	 */

	final private function __wakeup( ) { }



	/**
	 *	This method should be overriden initialize the object.
	 */

	protected function _initialize( ) { }

}
