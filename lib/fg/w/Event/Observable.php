<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Event;



/**
 *
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
	 */

	public function notify( Event $Event ) {

		foreach ( $this->_observers as $Observer ) {
			$Observer->handle( $Event );
		}
	}
}
