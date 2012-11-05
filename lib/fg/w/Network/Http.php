<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Network;



/**
 *	Handles HTTP related operations.
 *
 *	@package fg.w.Network
 */

class Http {

	/**
	 *	CURL handle.
	 *
	 *	@var
	 */

	protected $_curl = null;



	/**
	 *	Constructor.
	 *
	 *	@param array $settings ...
	 */

	public function __construct( array $settings = array( )) {

		$this->_curl = curl_init( );
		$this->configure( $settings );
	}



	/**
	 *	Closes the cURL handle.
	 */

	public function __destruct( ) {

		curl_close( $this->_curl );
	}



	/**
	 *
	 *
	 *	@param CURLOPT $option Option name.
	 *	@param mixed $value Option value.
	 */

	public function setOption( $option, $value ) {

		curl_setopt( $this->_curl, $option, $value );
	}



	/**
	 *
	 *
	 *	@param array $options
	 */

	public function setOptions( array $options ) {

		curl_setopt_array( $this->_curl, $options );
	}



	/**
	 *	Executes the cURL request.
	 *
	 *	@return boolean|string The execution result.
	 */

	public function exec( ) {

		$this->configure( CURLOPT_HEADER, false );

		return curl_exec( $this->_curl );
	}



	/**
	 *	Executes a POST request.
	 *
	 *	@param string $url The URL to query for.
	 *	@param array $data An array of data to send.
	 *	@param array $settings Optional settings.
	 *	@return boolean|string The execution result.
	 */

	public static function post( $url, array $data, array $settings = array( )) {

		$_this = new self( $settings );
		$_this->configure( CURLOPT_POST, true );
		$_this->configure( CURLOPT_POSTFIELDS, $data );

		return $_this->exec( );
	}



	/**
	 *	Executes a GET request.
	 *
	 *	@param string $url The URL to query for.
	 *	@param array $settings Optional settings.
	 *	@return boolean|string The execution result.
	 */

	public static function get( $url, array $settings = array( )) {

		$_this = new self( $settings );
		$_this->configure( CURLOPT_RETURN_TRANSFERT, true );

		return $_this->exec( );
	}



	/**
	 *	Executes a PUT request.
	 *
	 *	@param string $url The URL to query for.
	 *	@param array $data An array of data to send.
	 *	@param array $settings Optional settings.
	 *	@return boolean|string The execution result.
	 */

	public static function put( $url, array $data, array $settings = array( )) {

		$_this = new self( $settings );

		//

		return $_this->exec( );
	}



	/**
	 *	Executes a DELETE request.
	 *
	 *	@param string $url The URL to query for.
	 *	@return boolean|string The execution result.
	 */

	public static function delete( $url ) {

		$_this = new self( $settings );

		//

		return $_this->exec( );
	}
}
