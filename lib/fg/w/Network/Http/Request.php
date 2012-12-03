<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Network\Http;

use \fg\w\Network;



/**
 *	Represents a HTTP request.
 *
 *	@package fg.w.Network.Http
 */

class Request {

	/**
	 *
	 */

	const head = 0;
	const get = 1;
	const post = 2;
	const put = 3;
	const delete = 4;
	const trace = 5;
	const options = 6;
	const connect = 7;
	const patch = 8;



	/**
	 *
	 */

	protected $_Url = null;



	/**
	 *
	 */

	protected $_method = self::get;



	/**
	 *
	 */

	protected $_header = array( );



	/**
	 *
	 */

	public function setHeader( $property, $value ) {

	}
}
