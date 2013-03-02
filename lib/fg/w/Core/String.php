<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *	An utility class to manipulate strings.
 *
 *	@package fg.w.Core
 */

class String {

	/**
	 *	Finds the first position in which the $needle occurs in $haystack.
	 *
	 *	@param string $haystack The string to search in.
	 *	@param string $haystack The string to find.
	 */

	public static function indexOf( $haystack, $needle ) {

		return strpos( $haystack, $needle );
	}



	/**
	 *	Finds the last position in which the $needle occurs in $haystack.
	 *
	 *	@param string $haystack The string to search in.
	 *	@param string $haystack The string to find.
	 */

	public static function lastIndexOf( $haystack, $needle ) {

		return strrpos( $haystack, $needle );
	}



	/**
	 *	Returns if $haystack contains $needle.
	 *
	 *	@param string $haystack The string to search in.
	 *	@param string $haystack The string to find.
	 *	@return boolean True if the String contains $String, otherwise false.
	 */

	public static function contains( $haystack, $needle ) {

		return ( $this->indexOf( $haystack, $needle ) !== false );
	}



	/**
	 *	Returns if $haystack starts with $needle.
	 *
	 *	@param string $haystack The string to search in.
	 *	@param string $haystack The string to find.
	 *	@return boolean True if the String starts with $String, otherwise false.
	 */

	public static function startsWith( $haystack, $needle ) {

		return ( $this->indexOf( $haystack, $needle ) === 0 );
	}



	/**
	 *	Returns if $haystack ends with $needle.
	 *
	 *	@param string $haystack The string to search in.
	 *	@param string $haystack The string to find.
	 *	@return boolean True if the String ends with $String, otherwise false.
	 */

	public static function endsWith( $haystack, $needle ) {

		$gap = strlen( $haystack ) - strlen( $needle );

		return ( $this->lastIndexOf( $haystack, $needle ) === $gap );
	}



	/**
	 *	Splits the given string in multiple parts, delimited by $delimiter.
	 *
	 *	@param string $string The string to split.
	 *	@param string $delimiter Parts delimiter.
	 *	@param boolean $empty Whether or not to keep empty parts.
	 *	@return array An array of parts.
	 */

	public static function split( $string, $delimiter, $empty = false ) {

		if ( !is_string( $delimiter ) || empty( $delimiter )) {
			throw new \InvalidArgumentException( 'The delimiter must be a non-empty string' );
		}

		$parts = explode( $delimiter, $string );

		if ( !$empty ) {
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
