<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *	Number utilities.
 *
 *	@package fg.w.Core
 */

class Registry {

	/**
	 *
	 */

	protected static $_classes = array( );



	/**
	 *
	 */

	protected static $_instances = array( );



	/**
	 *
	 */

	public static function has( $name ) {

		return isset( $name, $this->_classes );
	}



	/**
	 *
	 */

	public static function get( $name, $default = null ) {

		if ( !$this->has( $name )) {
			return $default;
		}

		$factory = $this->_classes[ $name ]['factory'];

		if ( $this->_classes[ $name ]['unique']) {
			if ( !isset( $this->_instances[ $name ])) {
				$this->_instances[ $name ] = call_user_func( $factory );
			}

			return $this->_instances[ $name ];
		}

		return call_user_func( $factory );
	}



	/**
	 *
	 */

	public static function register( $name, callable $factory, $unique = false ) {

		self::$_classes[ $name ] = compact( 'factory', 'unique' );
	}
}
