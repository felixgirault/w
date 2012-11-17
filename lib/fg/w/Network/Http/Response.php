<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Network\Http;



/**
 *	Represents a HTTP response.
 *
 *	@package fg.w.Network.Http
 */

class Response {

	/**
	 *
	 */

	protected $_statuses = array(
		404 => 'Not found'
	);



	/**
	 *
	 */

	protected $_status;

}
