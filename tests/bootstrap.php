<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w;

require_once
	dirname( dirname( __FILE__ ))
	. DIRECTORY_SEPARATOR . 'lib'
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Core constants
 */

if ( !defined( 'W_TEST')) {
	define( 'W_TEST', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
}



/**
 *	Autoload
 */

$ClassLoader = new ClassLoader( W_TEST );
$ClassLoader->register( );
