<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *
 *
 *	@package fg.w.Core
 */

class Messager {

	/**
	 *
	 *
	 *	@var array
	 */

	protected $_subscribers = array( );



	/**
	 *
	 *
	 *	@param string $event The event name.
	 *	@param mixed $data The data to send to the subscribers.
	 */

	public function send( $event, $data ) {

		if ( isset( $this->_subscribers[ $event ])) {
			foreach ( $this->_subscribers[ $event ] as $callback ) {
				call_user_func( $callback, $data );
			}
		}
	}



	/**
	 *
	 *
	 *	@param string $event The event name.
	 *	@param callable $callback The callback to be executed when $event is fired.
	 */

	public function subscribe( $event, $callback ) {

		if ( !isset( $this->_subscribers[ $event ])) {
			$this->_subscribers[ $event ] = array( );
		}

		if ( !in_array( $callback, $this->_subscribers[ $event ])) {
			$this->_subscribers[ $event ][ ] = $callback;
		}
	}
}
