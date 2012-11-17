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

	public function testConstruct( ) {

		$String = new String( );
	}



	/**
	 *
	 */

	public function testLength( ) {

		$String = new String( 'test' );

		$this->assertEquals( $String->length( ), strlen( 'test' ));
	}



	/**
	 *
	 */

	public function testAt( ) {

		$String = new String( 'abcdef' );

		$this->assertEquals( $String->at( 0 ), 'a' );
		$this->assertEquals( $String->at( 1 ), 'b' );

		$this->assertEquals( $String->at( -1 ), 'f' );
		$this->assertEquals( $String->at( -2 ), 'e' );

		$this->assertNull( $String->at( 12 ));
		$this->assertNull( $String->at( -12 ));
	}



	/**
	 *
	 */

	public function testIndexOf( ) {

		$String = new String( 'test test string' );

		$this->assertEquals( $String->indexOf( 'test' ), 0 );
		$this->assertEquals( $String->indexOf( 'string' ), 10 );

		$this->assertFalse( $String->indexOf( 'foo' ));
	}



	/**
	 *
	 */

	public function testLastIndexOf( ) {

		$String = new String( 'test test string' );

		$this->assertEquals( $String->lastIndexOf( 'test' ), 5 );
		$this->assertEquals( $String->lastIndexOf( 'string' ), 10 );

		$this->assertFalse( $String->lastIndexOf( 'foo' ));
	}



	/**
	 *
	 */

	public function testContains( ) {

		$String = new String( 'test string' );

		$this->assertTrue( $String->contains( 'test' ));
		$this->assertFalse( $String->contains( 'foo' ));
	}



	/**
	 *
	 */

	public function testStartsWith( ) {

		$String = new String( 'test string' );

		$this->assertTrue( $String->startsWith( $String ));
		$this->assertTrue( $String->startsWith( 'test' ));

		$this->assertFalse( $String->startsWith( 'fail' ));
		$this->assertFalse( $String->startsWith( 'longer test string' ));
	}



	/**
	 *
	 */

	public function testEndsWith( ) {

		$String = new String( 'test string' );

		$this->assertTrue( $String->endsWith( $String ));
		$this->assertTrue( $String->endsWith( 'string' ));

		$this->assertFalse( $String->endsWith( 'fail' ));
		$this->assertFalse( $String->endsWith( 'longer test string' ));
	}



	/**
	 *
	 */

	public function testArg( ) {

		$String = new String( 'hello %s' );
		$String->arg( 'world' );

		$this->assertEquals( $String->buffer( ), 'hello world' );
		$this->assertEquals( $String->length( ), strlen( 'hello world' ));
	}



	/**
	 *
	 */

	public function testSplit( ) {

		$String = new String( 'test,,string' );

		$this->assertEquals( $String->split( ',' ), array( 'test', 'string' ));
		$this->assertEquals( $String->split( ',', false ), array( 'test', '', 'string' ));
	}



	/**
	 *
	 */

	public function testSplitWithInvalidDelimiter( ) {

		$this->setExpectedException( 'InvalidArgumentException' );

		$String = new String( 'test,,string' );
		$String->split( '' );
	}
}
