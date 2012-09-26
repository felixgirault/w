<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace w;



/**
 *
 *
 *	@package w
 */

class RegEx {

	/**
	 *
	 */

	protected $_pattern = '';



	/**
	 *
	 */

	protected $replacement = '';



	/**
	 *
	 */

	public function __construct( $pattern = '' ) {

		$this->setPattern( $pattern );
	}



	/**
	 *
	 */

	public function pattern( ) {

		return $this->_pattern;
	}



	/**
	 *
	 */

	public function setPattern( ) {

		$this->_pattern = $pattern;
	}



	/**
	 *
	 */

	public function matches( $string, $flags, $offset ) {

		$result = preg_match( $this->_pattern, $string, $matches, $flags, $offset );

		if ( $result === false ) {
			throw new Exception( );
		}


	}



	/**
	 *
	 */

	public function replace( ) {


	}
}
