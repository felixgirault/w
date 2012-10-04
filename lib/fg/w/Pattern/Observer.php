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

interface Observer {

	/**
	 *
	 */

	public function observe( Observable $Observable ) {

		$Observable->addObserver( $Observable );
	}



	/**
	 *
	 */

	public function stopObserving( Observable $Observable ) {

		$Observable->removeObserver( $Observable );
	}



	/**
	 *
	 */

	abstract public function processEvent( $name, array $data = array( ));

}
