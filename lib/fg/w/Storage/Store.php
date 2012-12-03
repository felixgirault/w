<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Storage;



/**
 *	Stores a collection of string indexed values.
 *
 *	@package fg.w.Storage
 */

class Store {

	/**
	 *
	 *
	 *	@param
	 */

	protected $_Engine = null;



	/**
	 *	Populates the store with the given data.
	 *
	 *	@param array $data Initial data.
	 */

	public function __construct( Engine $Engine ) {

		$this->_Engine = $Engine;
	}
}
