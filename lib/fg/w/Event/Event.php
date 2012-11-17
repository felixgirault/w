<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Event;



/**
 *	Represents a basic event.
 *
 *	@package fg.w.Event
 */

class Event {

	/**
	 *	Event type.
	 *
	 *	@var string
	 */

	protected $_type = '';



	/**
	 *	Constructs the event.
	 *
	 *	@param string $type The event type.
	 */

	public function __construct( $type ) {

		$this->_type = $type;
	}



	/**
	 *	Returns the event type.
	 *
	 *	@return string Type.
	 */

	public function type( ) {

		return $this->_type;
	}
}
