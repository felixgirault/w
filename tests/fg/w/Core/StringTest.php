<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for String.
 */

class StringTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public function testIndexOf( ) {

		$string = 'test test string';

		$this->assertEquals( String::indexOf( $string, 'test' ), 0 );
		$this->assertEquals( String::indexOf( $string, 'string' ), 10 );

		$this->assertFalse( String::indexOf( $string, 'foo' ));
	}



	/**
	 *
	 */

	public function testLastIndexOf( ) {

		$string = 'test test string';

		$this->assertEquals( String::lastIndexOf( $string, 'test' ), 5 );
		$this->assertEquals( String::lastIndexOf( $string, 'string' ), 10 );

		$this->assertFalse( String::lastIndexOf( $string, 'foo' ));
	}



	/**
	 *
	 */

	public function testContains( ) {

		$string = 'test string';

		$this->assertTrue( String::contains( $string, 'test' ));
		$this->assertFalse( String::contains( $string, 'foo' ));
	}



	/**
	 *
	 */

	public function testStartsWith( ) {

		$string = 'test string';

		$this->assertTrue( String::startsWith( $string, $string ));
		$this->assertTrue( String::startsWith( $string, 'test' ));

		$this->assertFalse( String::startsWith( $string, 'fail' ));
		$this->assertFalse( String::startsWith( $string, 'longer test string' ));
	}



	/**
	 *
	 */

	public function testEndsWith( ) {

		$string = 'test string';

		$this->assertTrue( String::endsWith( $string, $string ));
		$this->assertTrue( String::endsWith( $string, 'string' ));

		$this->assertFalse( String::endsWith( $string, 'fail' ));
		$this->assertFalse( String::endsWith( $string, 'longer test string' ));
	}



	/**
	 *
	 */

	public function testSplit( ) {

		$string = 'test,,string';

		$this->assertEquals( String::split( $string, ',' ), array( 'test', 'string' ));
		$this->assertEquals( String::split( $string, ',', false ), array( 'test', '', 'string' ));
	}



	/**
	 *
	 */

	public function testSplitWithInvalidDelimiter( ) {

		$this->setExpectedException( 'InvalidArgumentException' );

		String::split( 'test,,string', '' );
	}
}
