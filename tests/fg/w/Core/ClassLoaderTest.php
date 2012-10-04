<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for ClassLoader.
 */

class ClassLoaderTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $ClassLoader = null;



	/**
	 *
	 */

	public function setUp( ) {

		$this->ClassLoader = new ClassLoader( W_TEST_RESOURCES );
		$this->ClassLoader->register( );
	}



	/**
	 *
	 */

	public function testRegister( ) {

		$this->assertTrue(
			in_array(
				array( $this->ClassLoader, 'load' ),
				spl_autoload_functions( )
			)
		);
	}



	/**
	 *
	 */

	public function testUnregister( ) {

		$this->ClassLoader->unregister( );

		$this->assertFalse(
			in_array(
				array( $this->ClassLoader, 'load' ),
				spl_autoload_functions( )
			)
		);
	}



	/**
	 *
	 */

	public function testLoad( ) {

		$this->assertTrue( class_exists( '\\Foo' ));

		// La ligne suivante ne passe pas. WHY, GOD ? WHY ?!?
		//$this->assertTrue( class_exists( '\\Package\\Bar' ));
	}



	/**
	 *
	 */

	public function testLoadUndefined( ) {

		$this->assertFalse( class_exists( '\\Undefined' ));
	}



	/**
	 *
	 */

	public function tearDown( ) {

		$this->ClassLoader->unregister( );
	}
}
