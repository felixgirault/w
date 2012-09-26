<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace w;

require_once( dirname( dirname( __FILE__ )) . DIRECTORY_SEPARATOR . 'bootstrap.php' );



/**
 *	Test case for Package.
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

	public function testChar( ) {

		$String = new String( 'abcdef' );

		$this->assertEquals( $String->char( 0 ), 'a' );
		$this->assertEquals( $String->char( 1 ), 'b' );

		$this->assertEquals( $String->char( -1 ), 'f' );
		$this->assertEquals( $String->char( -2 ), 'e' );

		$this->assertNull( $String->char( 12 ));
		$this->assertNull( $String->char( -12 ));
	}



	/**
	 *
	 */

	public function testIndexOf( ) {

		$String = new String( 'test test string' );

		$this->assertEquals( $String->indexOf( new String( 'test' )), 0 );
		$this->assertEquals( $String->indexOf( new String( 'string' )), 10 );

		$this->assertFalse( $String->indexOf( new String( 'foo' )));
	}



	/**
	 *
	 */

	public function testLastIndexOf( ) {

		$String = new String( 'test test string' );

		$this->assertEquals( $String->lastIndexOf( new String( 'test' )), 5 );
		$this->assertEquals( $String->lastIndexOf( new String( 'string' )), 10 );

		$this->assertFalse( $String->lastIndexOf( new String( 'foo' )));
	}



	/**
	 *
	 */

	public function testContains( ) {

		$String = new String( 'test string' );

		$this->assertTrue( $String->contains( new String( 'test' )));
		$this->assertFalse( $String->contains( new String( 'foo' )));
	}



	/**
	 *
	 */

	public function testStartsWith( ) {

		$String = new String( 'test string' );

		$this->assertTrue( $String->startsWith( $String ));
		$this->assertTrue( $String->startsWith( new String( 'test' )));

		$this->assertFalse( $String->startsWith( new String( 'fail' )));
		$this->assertFalse( $String->startsWith( new String( 'longer test string' )));
	}



	/**
	 *
	 */

	public function testEndsWith( ) {

		$String = new String( 'test string' );

		$this->assertTrue( $String->endsWith( $String ));
		$this->assertTrue( $String->endsWith( new String( 'string' )));

		$this->assertFalse( $String->endsWith( new String( 'fail' )));
		$this->assertFalse( $String->endsWith( new String( 'longer test string' )));
	}



	/**
	 *
	 */

	public function testArg( ) {

		$String = new String( 'hello %s' );
		$String->arg( 'world' );

		$this->assertEquals( $String->data( ), 'hello world' );
		$this->assertEquals( $String->length( ), strlen( 'hello world' ));
	}



	/**
	 *
	 */

	public function testSplit( ) {

		$String = new String( 'test,,string' );

		$this->assertFalse( $String->split( '' ));
		$this->assertEquals( $String->split( ',' ), array( 'test', 'string' ));
		$this->assertEquals( $String->split( ',', false ), array( 'test', '', 'string' ));
	}
}
