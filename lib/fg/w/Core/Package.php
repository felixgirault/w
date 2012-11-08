<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *	Represents a package.
 *
 *	@package fg.w.Core
 */

class Package {

	/**
	 *	Path to the package.
	 *
	 *	@var string
	 */

	protected $_path = '';



	/**
	 *	Packages separator.
	 *
	 *	@var string
	 */

	protected $_separator = '';



	/**
	 *	Constructs a package located at the given path.
	 *
	 *	@param string $path Path to the package.
	 *	@param string $separator Packages separator.
	 */

	public function __construct( $path, $separator = '\\' ) {

		$this->_path = is_dir( $path )
			? rtrim( $path, DIRECTORY_SEPARATOR )
			: dirname( $path );

		$this->_separator = $separator;
	}



	/**
	 *	Returns the path to the package.
	 *
	 *	@return string Path.
	 */

	public function path( ) {

		return $this->_path;
	}



	/**
	 *	Sets the path to the package.
	 *
	 *	@param string Path.
	 */

	public function setPath( $path ) {

		$this->_path = $path;
	}



	/**
	 *	Returns the package separator.
	 *
	 *	@return string Package separator.
	 */

	public function separator( ) {

		return $this->_separator;
	}



	/**
	 *	Sets the package separator.
	 *
	 *	@param string Separator.
	 */

	public function setSeparator( $separator ) {

		$this->_separator = $separator;
	}



	/**
	 *	Scans the directory and returns the classes it contains.
	 *	Note: This method doesn't deal with symlinks.
	 *
	 *	@param string $package Sub packages in which to search for, relatively
	 *		to the base package path.
	 *	@param boolean $recursive Whether or not to search recursively.
	 *	@return array An array of directory and/or file paths.
	 */

	public function classes( $package = array( ), $recursive = false ) {

		$classes = array( );
		$searchPath $this->_path;

		if ( !empty( $package )) {
			$searchPath .= DIRECTORY_SEPARATOR
				. implode( DIRECTORY_SEPARATOR, $package );
		}

		$entries = scandir( $searchPath );

		if ( is_array( $entries )) {
			foreach ( $entries as $entry ) {
				$path = $searchPath . DIRECTORY_SEPARATOR . $entry;
				$parts = $package;
				$parts[ ] = basename( $entry, '.php' );

				if (
					$recursive
					&& is_dir( $path )
					&& ( $entry != '.' )
					&& ( $entry != '..' )
				) {
					$classes = array_merge(
						$classes,
						$this->classes( $parts, $recursive )
					);
				}

				if ( is_file( $path )) {
					$classes[ ] = implode( $this->_separator, $parts );
				}
			}
		}

		return $classes;
	}
}
