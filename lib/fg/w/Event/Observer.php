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

trait Observer {

	/**
	 *
	 */

	abstract public function handle( Event $Event );

}
