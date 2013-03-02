<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Event;



/**
 *	Dispatches events to callbacks.
 *
 *	@package fg.w.Event
 */

class Dispatcher {

	/**
	 *	Collection of subscribers indexed by event type.
	 *
	 *	@var array
	 */

	protected $_listeners = array( );



	/**
	 *	Attaches a callback to be called when an event is fired.
	 *
	 *	@param string $event The event name.
	 *	@param callable $callback The callback to attach.
	 */

	public function attach( $event, callable $callback ) {

		if ( !isset( $this->_listeners[ $event ])) {
			$this->_listeners[ $event ] = array( );
		}

		if ( !in_array( $callback, $this->_listeners[ $event ], true )) {
			$this->_listeners[ $event ][ ] = $callback;
		}
	}



	/**
	 *	Detaches a callback.
	 *
	 *	@param string $event The event name.
	 *	@param callable $callback The callback to detach.
	 */

	public function detach( $event, callable $callback ) {

		if ( isset( $this->_listeners[ $event ])) {
			$index = array_search( $callback, $this->_listeners, true );

			if ( $index !== false ) {
				$this->_listeners[ $event ][ $index ];
			}
		}
	}



	/**
	 *	Dispatches an event to appropriate listeners.
	 *
	 *	@param string $event The event name.
	 *	@param mixed $data The event data.
	 */

	public function dispatch( $event, $data ) {

		if ( !isset( $this->_listeners[ $event ])) {
			return;
		}

		foreach ( $this->_listeners[ $event ] as $callback ) {
			call_user_func( $callback, $data );
		}
	}
}
