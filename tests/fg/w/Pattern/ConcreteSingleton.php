<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;



/**
 *
 */

class ConcreteSingleton {

	/**
	 *
	 */

	use Singleton;



	/**
	 *
	 */

	public $initialized = false;



	/**
	 *
	 */

	protected function _initialize( ) {

		$this->initialized = true;
	}
}
