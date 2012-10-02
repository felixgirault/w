<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Network;



/**
 *	Represents a HTTP request.
 *
 *	@package fg.w.Network
 */

class HttpRequest {

	/**
	 *
	 */

	const HEAD = 0;
	const GET = 1;
	const POST = 2;
	const PUT = 3;
	const DELETE = 4;
	const TRACE = 5;
	const OPTIONS = 6;
	const CONNECT = 7;
	const PATCH = 8;



	/**
	 *
	 */

	protected $_method = self::GET;

}
