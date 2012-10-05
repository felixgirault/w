<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;



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

	public function processEvent( $name, array $data ) { }

}
