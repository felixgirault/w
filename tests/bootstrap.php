<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

require_once dirname( dirname( __FILE__ ))
	. DIRECTORY_SEPARATOR . 'lib'
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Core constants
 */

if ( !defined( 'W_TEST')) {
	define( 'W_TEST', dirname( __FILE__ ) . DIRECTORY_SEPARATOR );
}

if ( !defined( 'W_TEST_RESOURCES')) {
	define( 'W_TEST_RESOURCES', W_TEST . 'resources' . DIRECTORY_SEPARATOR );
}



/**
 *	Autoload
 */

$ClassLoader = new fg\w\Core\ClassLoader( W_TEST );
$ClassLoader->register( );
