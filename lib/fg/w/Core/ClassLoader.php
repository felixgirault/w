<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *	A simple PSR-0 compliant class loader.
 *
 *	@package fg.w.Core
 */

class ClassLoader {

	/**
	 *	Base include path for all class files.
	 *
	 *	@var array
	 */

	protected $_path = '';



	/**
	 *	Constructor.
	 *
	 *	@param string $path Base include path for all class files.
	 */

	public function __construct( $path = '' ) {

		$this->_path = is_dir( $path )
			? rtrim( $path, DIRECTORY_SEPARATOR )
			: dirname( $path );
	}



	/**
	 *	Registers this class loader on the SPL autoload stack.
	 */

	public function register( ) {

		spl_autoload_register( array( $this, 'load' ));
	}



	/**
	 *	Registers this class loader on the SPL autoload stack.
	 */

	public function unregister( ) {

		spl_autoload_unregister( array( $this, 'load' ));
	}



	/**
	 *  Loads the given class or interface.
	 *
	 *  @param string $className Name of the class to load.
	 */

	public function load( $className ) {

		$path = $this->_path
			. DIRECTORY_SEPARATOR
			. str_replace( '\\', DIRECTORY_SEPARATOR, $className )
			. '.php';

		if ( is_readable( $path )) {
			require_once $path;
		}
	}
}
