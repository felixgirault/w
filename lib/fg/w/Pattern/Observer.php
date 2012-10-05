<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;



/**
 *
 *
 *	@package fg.w.Pattern
 */

trait Observer {

	/**
	 *
	 */

	public function observe( $Observable ) {

		$Observable->addObserver( $this );
	}



	/**
	 *
	 */

	public function stopObserving( $Observable ) {

		$Observable->removeObserver( $this );
	}



	/**
	 *
	 */

	abstract public function processEvent( $name, array $data = array( ));

}
