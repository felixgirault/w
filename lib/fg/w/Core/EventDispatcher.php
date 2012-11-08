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

class EventDipatcher {

	/**
	 *
	 *
	 *	@var array
	 */

	protected $_subscribers = array( );



	/**
	 *	Fires the given event.
	 *
	 *	@param string $event The event name.
	 *	@param mixed $data The data to send to the subscribers.
	 */

	public function dispatch( $event, $data = null ) {

		if ( isset( $this->_subscribers[ $event ])) {
			foreach ( $this->_subscribers[ $event ] as $callback ) {
				call_user_func( $callback, $data );
			}
		}
	}



	/**
	 *	Registers a callback to be called when the given event is fired.
	 *
	 *	@param string $event The event name.
	 *	@param callable $callback The callback to be executed when $event is fired.
	 */

	public function subscribe( $event, callable $callback ) {

		if ( !isset( $this->_subscribers[ $event ])) {
			$this->_subscribers[ $event ] = array( );
		}

		if ( !in_array( $callback, $this->_subscribers[ $event ])) {
			$this->_subscribers[ $event ][ ] = $callback;
		}
	}
}
