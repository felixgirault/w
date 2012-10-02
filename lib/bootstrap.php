<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w;

require_once dirname( __FILE__ )
	. DIRECTORY_SEPARATOR . 'fg'
	. DIRECTORY_SEPARATOR . 'w'
	. DIRECTORY_SEPARATOR . 'Core'
	. DIRECTORY_SEPARATOR . 'ClassLoader.php';



/**
 *	Core constants
 */

if ( !defined( 'W_LIB')) {
	define( 'W_LIB', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
}



/**
 *	Autoload
 */

$ClassLoader = new ClassLoader( W_LIB );
$ClassLoader->register( );
