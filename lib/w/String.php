<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace w;



/**
 *	An utility class to manipulate strings.
 *
 *	@package w
 */

class String {

	/**
	 *	The actual string.
	 *
	 *	@var string
	 */

	protected $_buffer = '';



	/**
	 *	Length of the string.
	 *
	 *	@var int
	 */

	protected $_length = 0;



	/**
	 *	Constructs a String from the given string.
	 *
	 *	@param string $string
	 */

	public function __construct( $string = '' ) {

		$this->setData( $string );
	}



	/**
	 *	Returns the internal string.
	 *
	 *	@return string The internal string.
	 */

	public function buffer( ) {

		return $this->_buffer;
	}



	/**
	 *	Sets the internal string.
	 *
	 *	@param string $buffer The new internal string.
	 */

	public function setBuffer( $buffer ) {

		$this->_buffer = $buffer;
		$this->_length = strlen( $this->_buffer );
	}



	/**
	 *	Returns the length of the string.
	 *
	 *	@return int Length.
	 */

	public function length( ) {

		return $this->_length;
	}



	/**
	 *	Returns the character at the given position in the string.
	 *	If the position is negative, search will start from that many characters
	 *	from the end of the string, searching backwards.
	 *
	 *	@param int $i Character position.
	 *	@return mixed A character if $i is a valid position (0 <= $i < length( )),
	 *		otherwise null.
	 */

	public function char( $i ) {

		if ( $i < 0 ) {
			$i += $this->length( );
		}

		if (( $i >= 0 ) && ( $i < $this->length( ))) {
			return $this->_buffer[ $i ];
		}

		return null;
	}



	/**
	 *
	 */

	public function indexOf( String $String ) {

		return strpos( $this->_buffer, $String->_buffer );
	}



	/**
	 *
	 */

	public function lastIndexOf( String $String ) {

		return strrpos( $this->_buffer, $String->_buffer );
	}



	/**
	 *	Returns if the String contains the given String.
	 *
	 *	@param String $String
	 *	@return boolean True if the String contains $String, otherwise false.
	 */

	public function contains( String $String ) {

		return ( $this->indexOf( $String ) !== false );
	}



	/**
	 *	Returns if the String starts with the given one.
	 *
	 *	@param String $String The starting string.
	 *	@return boolean True if the String starts with $String, otherwise false.
	 */

	public function startsWith( String $String ) {

		return ( $this->indexOf( $String ) === 0 );
	}



	/**
	 *	Returns if the String ends with the given one.
	 *
	 *	@param String $String The ending string.
	 *	@return boolean True if the String ends with $String, otherwise false.
	 */

	public function endsWith( String $String ) {

		$gap = $this->length( ) - $String->length( );

		return ( $this->lastIndexOf( $String ) === $gap );
	}



	/**
	 *	Insert arguments in the String. For this method to work, String should
	 *	be formatted like printf( ) format.
	 *
	 *	@param mixed $arguments Multiple arguments to be inserted in the string.
	 */

	public function arg( $arguments ) {

		if ( func_num_args( ) > 0 ) {
			$this->setData( vsprintf( $this->_buffer, func_get_args( )));
		}
	}



	/**
	 *	Splits the String in multiple parts, delimited by $delimiter.
	 *
	 *	@param string $delimiter Parts delimiter.
	 *	@param boolean $skipEmptyParts Whether or not to remove empty parts from
	 *		the returned array.
	 *	@return mixed An array of parts, or false if $delimiter is an empty
	 *		string.
	 */

	public function split( $delimiter, $skipEmptyParts = true ) {

		if ( $delimiter === '' ) {
			return false;
		}

		$parts = explode( $delimiter, $this->_buffer );

		if ( $skipEmptyParts ) {
			$parts = array_values(
				array_filter(
					$parts,
					function( $part ) {
						return !empty( $part );
					}
				)
			);
		}

		return $parts;
	}
}
