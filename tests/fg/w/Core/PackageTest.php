<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for Package.
 */

class PackageTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Package = null;



	/**
	 *
	 */

	public function setUp( ) {

		$this->Package = new Package( W_TEST_RESOURCES );
	}



	/**
	 *
	 */

	public function testPath( ) {

		$dir = dirname( __FILE__ );

		$Package = new Package( $dir );
		$this->assertEquals( $dir, $Package->path( ));
	}



	/**
	 *
	 */

	public function testFilePath( ) {

		$dir = dirname( __FILE__ );

		$Package = new Package( __FILE__ );
		$this->assertEquals( $dir, $Package->path( ));
	}



	/**
	 *
	 */

	public function testSeparator( ) {

		$Package = new Package( 'foo', '_' );
		$this->assertEquals( '_', $Package->separator( ));
	}



	/**
	 *
	 */

	public function testClasses( ) {

		$this->assertEquals(
			array(
				'Foo'
			),
			$this->Package->classes( )
		);
	}



	/**
	 *
	 */

	public function testClassesRecursive( ) {

		$this->assertEquals(
			array(
				'Foo',
				'Package\\Bar',
				'Package\\SubPackage\\Baz'
			),
			$this->Package->classes( array( ), true )
		);
	}



	/**
	 *
	 */

	public function testClassesSubPackage( ) {

		$this->assertEquals(
			array(
				'Package\\Bar'
			),
			$this->Package->classes( array( 'Package' ))
		);
	}
}
