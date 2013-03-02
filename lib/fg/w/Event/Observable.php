<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Event;



/**
 *	Makes an object observable by observers objects.
 *
 *	@package fg.w.Event
 */

trait Observable {

	/**
	 *	Collection of observers.
	 *
	 *	@var array
	 */

	protected $_observers = array( );



	/**
	 *	Attaches an observer to be notified on events.
	 *
	 *	@param Observer $Observer Observer to attach.
	 */

	public function attach( Observer $Observer ) {

		if ( !in_array( $Observer, $this->_observers, true )) {
			$this->_observers[ ] = $Observer;
		}
	}



	/**
	 *	Detaches an observer.
	 *
	 *	@param Observer $Observer Observer to detach.
	 */

	public function detach( Observer $Observer ) {

		$index = array_search( $Observer, $this->_observers, true );

		if ( $index !== false ) {
			unset( $this->_observers[ $index ]);
		}
	}



	/**
	 *	Sends an event to all attached observers.
	 *
	 *	@param Event $Event The event to send.
	 *	@param data
	 */

	public function notify( $event ) {

		$args = func_get_args( );
		$argCount = count( $args );

		foreach ( $this->_observers as $Observer ) {
			switch ( $argCount ) {
				case 1:
					$Observer->handle( $event );
					break:

				case 2:
					$Observer->handle( $event, $args[ 1 ]);
					break:

				case 3:
					$Observer->handle( $event, $args[ 1 ], $args[ 2 ]);
					break:

				case 4:
					$Observer->handle( $event, $args[ 1 ], $args[ 2 ], $args[ 3 ]);
					break:

				default:
					call_user_func_array( array( $Observer, 'handle' ), $args );
					break;
			}
		}
	}
}
