<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Http;



/**
 *	An utility class to manipulate URLs.
 *
 *	@package fg.w.Http
 */

class Url {

	/**
	 *	Constants to identify URL components.
	 */

	const scheme = 'scheme';
	const user = 'user';
	const password = 'pass';
	const host = 'host';
	const port = 'port';
	const path = 'path';
	const params = 'query';
	const fragment = 'fragment';



	/**
	 *	Default values of URL components.
	 *
	 *	@var array
	 */

	protected $_defaults = array(
		self::scheme => '',
		self::user => '',
		self::password => '',
		self::host => '',
		self::port => '',
		self::path => '/',
		self::params => array( ),
		self::fragment => ''
	);



	/**
	 *	The URL components.
	 *
	 *	@var array
	 */

	protected $_components = array( );



	/**
	 *	The text version of the URL.
	 *
	 *	@var string
	 */

	protected $_string = '';



	/**
	 *	Constructor.
	 *
	 *	@see setString( )
	 *	@see setComponents( )
	 *	@param string|array $url An URL string, or an array of URL components.
	 */

	public function __construct( $url = '' ) {

		if ( is_string( $url )) {
			$this->setString( $url );
		} else if ( is_array( $url )) {
			$this->setComponents( $url );
		}
	}



	/**
	 *	Returns the URL as a string.
	 *
	 *	@return string URL.
	 */

	public function __toString( ) {

		return $this->get( );
	}



	/**
	 *	Clears the internal cache.
	 */

	protected function _clear( ) {

		$this->_string = '';
	}



	/**
	 *	Returns the URL as a string.
	 *
	 *	@return string The URL.
	 */

	public function string( ) {

		if ( empty( $this->_string )) {
			$this->_build( );
		}

		return $this->_string;
	}



	/**
	 *	Builds and returns the URL as a string.
	 *
	 *	@return string URL.
	 */

	protected function _build( ) {

		$user = $this->_pair( $this->user( ), $this->password( ));
		$host = $this->_pair( $this->host( ), $this->port( ));

		$this->_string = $this->scheme( ) . '://';
		$this->_string .= $this->_pair( $user, $host, '@' );
		$this->_string .= $this->path( );

		if ( $this->hasParams( )) {
			$this->_string .= '?' . http_build_query( $this->params( ));
		}

		if ( $this->hasFragment( )) {
			$this->_string .= '#' . $this->fragment( );
		}
	}



	/**
	 *	Makes a pair from the given parameters.
	 *
	 *	@param string $one First value.
	 *	@param string $two Second value.
	 *	@param string $glue The glue between strings.
	 *	@return string Paired values.
	 */

	protected function _pair( $one, $two, $glue = ':' ) {

		return trim( implode( $glue, array( $one, $two )), $glue );
	}



	/**
	 *	Sets a new URL.
	 *
	 *	@param string $url The new URL.
	 */

	public function setString( $url = '' ) {

		$this->_components = empty( $url )
			? $this->_defaults
			: array_merge(
				$this->_defaults,
				$this->_parse( $url )
			);

		$this->_string = $url;
	}



	/**
	 *	Parses the given URL.
	 *
	 *	@param string $url The URL to parse.
	 */

	protected function _parse( $url ) {

		$components = parse_url( $url );

		if ( $components === false ) {
			throw new Exception( 'Unable to parse url.' );
		}

		if ( isset( $components[ self::params ])) {
			parse_str(
				$components[ self::params ],
				$components[ self::params ]
			);
		}

		return $components;
	}



	/**
	 *	Returns the URL components.
	 *
	 *	@return array URL components.
	 */

	public function components( ) {

		return $this->_components;
	}



	/**
	 *	Sets the URL components.
	 *
	 *	@param array $components URL components.
	 */

	public function setComponents( $components ) {

		$this->_components = array_merge(
			$this->_defaults,
			array_intersect_key(
				$components,
				$this->_defaults
			)
		);

		$this->_clear( );
	}



	/**
	 *	Returns if the URL has a scheme.
	 *
	 *	@return boolean Whether the URL has a scheme.
	 */

	public function hasScheme( ) {

		return !empty( $this->_components[ self::scheme ]);
	}



	/**
	 *	Returns the URL scheme.
	 *
	 *	@return string Scheme.
	 */

	public function scheme( ) {

		return $this->_components[ self::scheme ];
	}



	/**
	 *	Sets the URL scheme.
	 *
	 *	@param string $scheme Scheme.
	 */

	public function setScheme( $scheme ) {

		$this->_components[ self::scheme ] = $scheme;
		$this->_clear( );
	}



	/**
	 *	Returns if the URL has a user.
	 *
	 *	@return boolean Whether the URL has a user.
	 */

	public function hasUser( ) {

		return !empty( $this->_components[ self::user ]);
	}



	/**
	 *	Returns the URL user.
	 *
	 *	@return string User.
	 */

	public function user( ) {

		return $this->_components[ self::user ];
	}



	/**
	 *	Sets the URL user.
	 *
	 *	@param string $user User.
	 */

	public function setUser( $user ) {

		$this->_components[ self::user ] = $user;
		$this->_clear( );
	}



	/**
	 *	Returns if the URL has a password.
	 *
	 *	@return boolean Whether the URL has a password.
	 */

	public function hasPassword( ) {

		return !empty( $this->_components[ self::password ]);
	}



	/**
	 *	Returns the URL password.
	 *
	 *	@return string Password.
	 */

	public function password( ) {

		return $this->_components[ self::password ];
	}



	/**
	 *	Sets the URL password.
	 *
	 *	@param string $password Password.
	 */

	public function setPassword( $password ) {

		$this->_components[ self::password ] = $password;
		$this->_clear( );
	}



	/**
	 *	Returns if the URL has a host.
	 *
	 *	@return boolean Whether the URL has a host.
	 */

	public function hasHost( ) {

		return !empty( $this->_components[ self::host ]);
	}



	/**
	 *	Returns the URL host.
	 *
	 *	@return string Host.
	 */

	public function host( ) {

		return $this->_components[ self::host ];
	}



	/**
	 *	Sets the URL host.
	 *
	 *	@param string $host Host.
	 */

	public function setHost( $host ) {

		$this->_components[ self::host ] = $host;
		$this->_clear( );
	}



	/**
	 *	Returns if the URL has a port.
	 *
	 *	@return boolean Whether the URL has a port.
	 */

	public function hasPort( ) {

		return !empty( $this->_components[ self::port ]);
	}



	/**
	 *	Returns the URL port.
	 *
	 *	@return string Port.
	 */

	public function port( ) {

		return $this->_components[ self::port ];
	}



	/**
	 *	Sets the URL port.
	 *
	 *	@param string $port Port.
	 */

	public function setPort( $port ) {

		$this->_components[ self::port ] = $port;
		$this->_clear( );
	}



	/**
	 *	Returns if the URL has a path.
	 *
	 *	@return boolean Whether the URL has a path.
	 */

	public function hasPath( ) {

		return !empty( $this->_components[ self::path ]);
	}



	/**
	 *	Returns the URL path.
	 *
	 *	@return string Path.
	 */

	public function path( ) {

		return $this->_components[ self::path ];
	}



	/**
	 *	Sets the URL path.
	 *
	 *	@param string $path Path.
	 */

	public function setPath( $path ) {

		$this->_components[ self::path ] = $path;
		$this->_clear( );
	}



	/**
	 *	Returns if the URL has the given parameter.
	 *
	 *	@param string $name Parameter name.
	 *	@return boolean Whether the URL has the parameter.
	 */

	public function hasParam( $name ) {

		return !empty( $this->_components[ self::params ][ $name ]);
	}



	/**
	 *	Returns if the URL has any parameter.
	 *
	 *	@return boolean Whether the URL has any parameter.
	 */

	public function hasParams( ) {

		return !empty( $this->_components[ self::params ]);
	}



	/**
	 *	Returns the requested URL parameter.
	 *
	 *	@param string $name Parameter name.
	 *	@return mixed Parameter value.
	 */

	public function param( $name ) {

		return isset( $this->_components[ self::params ][ $name ])
			? $this->_components[ self::params ][ $name ]
			: false;
	}



	/**
	 *	Returns the URL parameters.
	 *
	 *	@return array Parameters.
	 */

	public function params( ) {

		return $this->_components[ self::params ];
	}



	/**
	 *	Sets a particular URL parameter.
	 *
	 *	@param string $name Parameter name.
	 *	@param mixed $value Parameter value.
	 */

	public function setParam( $name, $value ) {

		$this->_components[ self::params ][ $name ] = $value;
		$this->_clear( );
	}



	/**
	 *	Sets the URL parameters.
	 *
	 *	@param array $params Parameters.
	 */

	public function setParams( array $params ) {

		$this->_components[ self::params ] = $params;
		$this->_clear( );
	}



	/**
	 *	Returns if the URL has a fragment.
	 *
	 *	@return boolean Whether the URL has a fragment.
	 */

	public function hasFragment( ) {

		return !empty( $this->_components[ self::fragment ]);
	}



	/**
	 *	Returns the URL fragment.
	 *
	 *	@return string Fragment.
	 */

	public function fragment( ) {

		return $this->_components[ self::fragment ];
	}



	/**
	 *	Sets the URL fragment.
	 *
	 *	@param string $fragment Fragment.
	 */

	public function setFragment( $fragment ) {

		$this->_components[ self::fragment ] = $fragment;
		$this->_clear( );
	}
}
