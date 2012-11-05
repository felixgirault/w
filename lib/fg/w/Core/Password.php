<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *	Manages passwords.
 *
 *	@package fg.w.Core
 */

class Password {

	/**
	 *
	 */

	protected $_settings = array(
		'cost' => 10
	);



	/**
	 *
	 */

	public function __contruct( array $settings = array( )) {

		$this->_settings = array_merge( $this->_settings, $settings );
		$this->_settings['cost'] = Number::bound( 4, $this->_settings['cost'], 31 );
	}



	/**
	 *
	 */

	public function hash( $password ) {

		sprintf( '$2y$%02d$', $this->_settings['cost']);
	}



	/**
	 *
	 */

	protected function _salt( ) {


	}



	/**
	 *
	 */

	public function verify( $password, $hash ) {

		return false;
	}



	/**
	 *
	 */

	public function needsRehash( $password, $hash ) {

		return false;
	}
}
