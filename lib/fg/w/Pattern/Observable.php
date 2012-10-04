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

interface Observable {

	/**
	 *
	 */

	protected $_observers = array( );



	/**
	 *
	 */

	public function addObserver( Observer $Observer ) {

		if ( !in_array( $Observer, $this->_observers )) {
			$this->_observers[ ] = $Observer;
		}
	}



	/**
	 *
	 */

	public function removeObserver( Observer $Observer ) {

		$index = array_search( $Observer, $this->_observers );

		if ( $index !== false ) {
			unset( $this->_observers[ $index ]);
		}
	}



	/**
	 *
	 */

	public function dispatchEvent( $name, array $data = array( )) {

		foreach ( $this->_observers as $Observer ) {
			$Observer->processEvent( $name, $data );
		}
	}
}
