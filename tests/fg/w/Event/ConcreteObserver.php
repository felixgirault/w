<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Event;



/**
 *
 */

class ConcreteObserver {

	/**
	 *
	 */

	use Observer;



	/**
	 *
	 */

	public function handle( Event $Event ) { }

}
