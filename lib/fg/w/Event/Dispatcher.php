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

	protected $_subscribers = array( );



	/**
	 *	Attaches a callback to be called when an event of the given type is fired.
	 *
	 *	@param string $eventType The event type.
	 *	@param callable $callback The callback to attach.
	 */

	public function attach( $eventType, callable $callback ) {

		if ( !isset( $this->_subscribers[ $eventType ])) {
			$this->_subscribers[ $eventType ] = array( );
		}

		if ( !in_array( $callback, $this->_subscribers[ $eventType ], true )) {
			$this->_subscribers[ $eventType ][ ] = $callback;
		}
	}



	/**
	 *	Detaches a callback.
	 *
	 *	@param string $eventType The event type.
	 *	@param callable $callback The callback to detach.
	 */

	public function detach( $eventType, callable $callback ) {

		if ( isset( $this->_subscribers[ $eventType ])) {
			$index = array_search( $callback, $this->_subscribers, true );

			if ( $index !== false ) {
				$this->_subscribers[ $eventType ][ $index ];
			}
		}
	}



	/**
	 *	Dispatches the given event to appropriate callbacks.
	 *
	 *	@param string $event The event to send.
	 */

	public function dispatch( Event $Event ) {

		$type = $Event->type( );

		if ( isset( $this->_subscribers[ $type ])) {
			foreach ( $this->_subscribers[ $type ] as $callback ) {
				call_user_func( $callback, $Event );
			}
		}
	}
}
