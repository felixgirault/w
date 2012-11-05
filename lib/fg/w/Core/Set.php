<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *	.
 *
 *	@package fg.w.Core
 */

class Set {

	/**
	 *	Path separator.
	 */

	protected $_ps = '.';



	/**
	 *
	 */

	protected $_data = array( );



	/**
	 *
	 */

	public function __construct( array $data = array( )) {

		$this->_data = $data;
	}



	/**
	 *
	 */

	public function has( $path ) {

		return strpos( $path, $this->_ps );
	}



	/**
	 *
	 */

	public function get( $path, $default = false ) {

		if ( isset( $this->_data[ $path ])) {
			return $this->_data[ $path ];
		}

		if ( $this->_isPath( $path )) {

		}

		return $default;
	}



	/**
	 *
	 */

	public function set( $path, $value ) {

		if ( $this->_isPath( $path )) {

		}
	}



	/**
	 *
	 */

	protected function _isPath( $string ) {

		return ( strpos( $path, $this->_ps ) !== false );
	}



	/**
	 *	Doesn't care for keys.
	 */

	public function append( $data ) {

		$this->_arrayify( $data );

		foreach ( $data as $key => $value ) {
			$data[ ] = $value;
		}
	}



	/**
	 *
	 */

	public function merge( $data, $recursive = false ) {

		$this->_arrayify( $data );
		$this->_data = $recursive
			? array_merge_recursive( $this->_data, $data )
			: array_merge( $this->_data, $data );
	}



	/**
	 *
	 */

	protected function _arrayify( &$data ) {

		if ( !is_array( $data )) {
			$data =& ( $data instanceof Set )
				? $data->_data
				: array( $data );
		}
	}
}
