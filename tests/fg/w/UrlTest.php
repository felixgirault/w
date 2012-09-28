<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w;

require_once
	dirname( dirname( dirname( __FILE__ )))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for Url.
 */

class UrlTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Url = null;



	/**
	 *
	 */

	public function setUp( ) {

		$this->Url = new Url( );
	}



	/**
	 *
	 */

	public function testScheme( ) {

		$this->assertFalse( $this->Url->hasScheme( ));

		$this->Url->set( 'http://www.example.com' );
		$this->assertTrue( $this->Url->hasScheme( ));
		$this->assertEquals( 'http', $this->Url->scheme( ));

		$this->Url->setScheme( 'ftp' );
		$this->assertEquals( 'ftp', $this->Url->scheme( ));

		$this->assertEquals(
			'ftp://www.example.com',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testUser( ) {

		$this->assertFalse( $this->Url->hasUser( ));

		$this->Url->set( 'http://user:password@www.example.com' );
		$this->assertTrue( $this->Url->hasUser( ));
		$this->assertEquals( 'user', $this->Url->user( ));

		$this->Url->setUser( 'test' );
		$this->assertEquals( 'test', $this->Url->user( ));

		$this->assertEquals(
			'http://test:password@www.example.com',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testPassword( ) {

		$this->assertFalse( $this->Url->hasPassword( ));

		$this->Url->set( 'http://user:password@www.example.com' );
		$this->assertTrue( $this->Url->hasPassword( ));
		$this->assertEquals( 'password', $this->Url->password( ));

		$this->Url->setPassword( 'test' );
		$this->assertEquals( 'test', $this->Url->password( ));

		$this->assertEquals(
			'http://user:test@www.example.com',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testHost( ) {

		$this->assertFalse( $this->Url->hasHost( ));

		$this->Url->set( 'http://www.example.com' );
		$this->assertTrue( $this->Url->hasHost( ));
		$this->assertEquals( 'www.example.com', $this->Url->host( ));

		$this->Url->setHost( 'www.test.com' );
		$this->assertEquals( 'www.test.com', $this->Url->host( ));

		$this->assertEquals(
			'http://www.test.com',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testPort( ) {

		$this->assertFalse( $this->Url->hasPort( ));

		$this->Url->set( 'http://www.example.com:80' );
		$this->assertTrue( $this->Url->hasPort( ));
		$this->assertEquals( '80', $this->Url->port( ));

		$this->Url->setPort( '12' );
		$this->assertEquals( '12', $this->Url->port( ));

		$this->assertEquals(
			'http://www.example.com:12',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testPath( ) {

		$this->assertFalse( $this->Url->hasPath( ));

		$this->Url->set( 'http://www.example.com/path/to/file.php' );
		$this->assertTrue( $this->Url->hasPath( ));
		$this->assertEquals( '/path/to/file.php', $this->Url->path( ));

		$this->Url->setPath( '/path/to/otherfile.php' );
		$this->assertEquals( '/path/to/otherfile.php', $this->Url->path( ));

		$this->assertEquals(
			'http://www.example.com/path/to/otherfile.php',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testParams( ) {

		$this->assertFalse( $this->Url->hasParams( ));

		$this->Url->set( 'http://www.example.com/path/to/file.php?foo=a&bar=b' );
		$this->assertTrue( $this->Url->hasParams( ));
		$this->assertEquals(
			array(
				'foo' => 'a',
				'bar' => 'b'
			),
			$this->Url->params( )
		);

		$this->Url->setParams( array( 'foo' => 'bar' ));
		$this->assertEquals( array( 'foo' => 'bar' ), $this->Url->params( ));

		$this->Url->setParams( array( 'foo' => array( 'sushi' => 'bar' )));
		$this->assertEquals( array( 'foo' => array( 'sushi' => 'bar' )), $this->Url->params( ));

		$this->assertEquals(
			'http://www.example.com/path/to/file.php?foo%5Bsushi%5D=bar',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testParam( ) {

		$this->assertFalse( $this->Url->hasParam( 'foo' ));

		$this->Url->set( 'http://www.example.com/path/to/file.php?foo=a' );
		$this->assertTrue( $this->Url->hasParam( 'foo' ));
		$this->assertEquals( 'a', $this->Url->param( 'foo' ));

		$this->Url->setParam( 'bar', 'b' );
		$this->assertEquals( 'b', $this->Url->param( 'bar' ));

		$this->Url->setParam( 'foo', array( 'sushi' => 'bar' ));
		$this->assertEquals( array( 'sushi' => 'bar' ), $this->Url->param( 'foo' ));

		$this->assertEquals(
			'http://www.example.com/path/to/file.php?foo%5Bsushi%5D=bar&bar=b',
			$this->Url->get( )
		);
	}



	/**
	 *
	 */

	public function testFragment( ) {

		$this->assertFalse( $this->Url->hasFragment( ));

		$this->Url->set( 'http://www.example.com/path/to/file.php#fragment' );
		$this->assertTrue( $this->Url->hasFragment( ));
		$this->assertEquals( 'fragment', $this->Url->fragment( ));

		$this->Url->setFragment( 'otherfragment' );
		$this->assertEquals( 'otherfragment', $this->Url->fragment( ));

		$this->assertEquals(
			'http://www.example.com/path/to/file.php#otherfragment',
			$this->Url->get( )
		);
	}
}
