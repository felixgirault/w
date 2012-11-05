<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;



/**
 *	An implementation of the circuit breaker pattern.
 *
 *	@package fg.w.Pattern
 */

trait CircuitBreaker {

	/**
	 *
	 *
	 *	@var string
	 */

	protected $_name;



	/**
	 *
	 *
	 *	@var integer
	 */

	protected $_treshold;



	/**
	 *	Seconds.
	 *
	 *	@var integer
	 */

	protected $_timeout;



	/**
	 *
	 *
	 *	@var integer
	 */

	protected $_failures = 0;



	/**
	 *
	 */

	protected $_lastFailure = 0;



	/**
	 *
	 */

	public function __construct( $name, $treshold = 10, $timeout = 60 ) {

		$this->_name = $name;
		$this->_treshold = $treshold;
		$this->_timeout = $timeout;
	}



	/**
	 *
	 */

	public function isClosed( ) {

		if ( $this->_failures < $this->_treshold ) {
			return true;
		}

		$interval = time( ) - $this->_lastFailure;

		if ( $interval > $timeout ) {

		}
	}



	/**
	 *
	 */

	public function reportSuccess( ) {

		if ( $this->_failures > 0 ) {
			$this->_failures--;
		}
	}



	/**
	 *
	 */

	public function reportFailure( ) {

		if ( $this->_failures < $this->_treshold ) {
			$this->_failures++;
		}

		$this->_lastFailure = time( );
	}
}
