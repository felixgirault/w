<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Storage\Engine\Array\Nested;

require_once dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ))))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *
 */

class NestedTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Nested = null;



	/**
	 *
	 */

	public $data = array(
		'foo' => array(
			'bar' => 12
		)
	);



	/**
	 *
	 */

	public function setUp( ) {

		$this->Nested = new Nested( $this->data );
	}



	/**
	 *
	 */

	public function testHas( ) {

		$this->assertTrue( $this->Nested->has( 'foo' ));
		$this->assertTrue( $this->Nested->has( 'foo.bar' ));
		$this->assertFalse( $this->Nested->has( 'bar' ));
	}



	/**
	 *
	 */

	public function testWrite( ) {

		$this->Nested->write( 'foo.bar', 12 );
		$this->assertEquals( 12, $this->Nested->read( 'foo.bar' ));

		$this->Nested->write( 'foo.baz', 12 );
		$this->assertEquals( 12, $this->Nested->read( 'foo.baz' ));

		$this->Nested->write( 'foo', 12 );
		$this->assertEquals( 12, $this->Nested->read( 'foo' ));
	}



	/**
	 *
	 */

	public function testWriteAll( ) {

		$data = array(
			'one' => 1,
			'two' => array(
				'three' => 3
			)
		);

		$this->Nested->writeAll( $data );
		$this->assertEquals( $data, $this->Nested->readAll( ));
	}



	/**
	 *
	 */

	public function testRead( ) {

		$this->assertEquals( $this->data['foo'], $this->Nested->read( 'foo' ));
		$this->assertEquals( $this->data['foo']['bar'], $this->Nested->read( 'foo.bar' ));
	}



	/**
	 *
	 */

	public function testReadAll( ) {

		$this->assertEquals( $this->data, $this->Nested->readAll( ));
	}



	/**
	 *
	 */

	public function testDelete( ) {

		$this->Nested->delete( 'foo.bar' );
		$this->assertFalse( $this->Nested->has( 'foo.bar' ));

		$this->Nested->delete( 'foo' );
		$this->assertFalse( $this->Nested->has( 'foo' ));
	}
}
