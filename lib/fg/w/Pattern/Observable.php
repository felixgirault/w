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

trait Observable {

	/**
	 *
	 */

	protected $_observers = array( );



	/**
	 *
	 */

	public function observers( ) {

		return $this->_observers;
	}



	/**
	 *
	 */

	public function addObserver( $Observer ) {

		if ( !in_array( $Observer, $this->_observers )) {
			$this->_observers[ ] = $Observer;
		}
	}



	/**
	 *
	 */

	public function removeObserver( $Observer ) {

		$index = array_search( $Observer, $this->_observers );

		if ( $index !== false ) {
			unset( $this->_observers[ $index ]);
		}
	}



	/**
	 *
	 */

	public function fireEvent( $name, array $data = array( )) {

		foreach ( $this->_observers as $Observer ) {
			$Observer->processEvent( $name, $data );
		}
	}
}
