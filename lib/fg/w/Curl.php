<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w;



/**
 *	Curl is an object wrapper for the cURL library.
 *
 *	@package fg.w
 */

class Curl {

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
	 *	Configures cURL by different ways.
	 *
	 *	$Curly->configure( CURLOPT );
	 *
	 *	@param CURLOPT|array $key Either a CURLOPT constant if $value is a
	 *		boolean, or an array of CURLOPT constants if $value is an array
	 *		of values, or an array of ( CURLOPT => value ) if $value is null.
	 *	@param boolean|array $value Either a boolean if $key is a CURLOPT, or
	 *		an array of values if $key is an array of CURLOPTs, or null if
	 *		$key is an array of ( CURLOPT => value ).
	 */

	public function configure( $key, $value = null ) {

		if ( is_array( $key )) {
			if ( is_array( $value )) {
				$settings = array_combine( $key, $value );
			} else {
				$settings = $key;
			}
		} else {
			$settings = array( $key => $value );
		}

		curl_setopt_array( $this->_curl, $settings );
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
