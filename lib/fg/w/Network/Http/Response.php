<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Network\Http;

use \fg\w\Network;



/**
 *	Represents a HTTP response.
 *
 *	@package fg.w.Network.Http
 */

class Response {

	/**
	 *
	 */

	const statuses = array(
		404 => 'Not found'
	);



	/**
	 *
	 */

	protected $_Url = null;



	/**
	 *
	 */

	protected $_status;



	/**
	 *
	 */

	public function __construct( Url $Url ) {

	}



	/**
	 *
	 */

	public function status( ) {

		return $this->_status;
	}



	/**
	 *
	 */

	public function statusMessage( ) {

		return $this->_statuses[ $this->_status ];
	}
}
