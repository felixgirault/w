<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com
 *	@license
 */

namespace fg\w\Storage;



/**
 *
 */

class StoreTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Store = null;



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

		$this->Store = new Store( $this->data	);
	}



	/**
	 *
	 */

	public function testHas( ) {

		$this->assertTrue( $this->Store->has( 'foo' ));
		$this->assertTrue( $this->Store->has( 'foo.bar' ));
		$this->assertFalse( $this->Store->has( 'bar' ));
	}



	/**
	 *
	 */

	public function testWrite( ) {

		$this->Store->write( 'foo.bar', 12 );
		$this->assertEquals( 12, $this->Store->read( 'foo.bar' ));

		$this->Store->write( 'foo.baz', 12 );
		$this->assertEquals( 12, $this->Store->read( 'foo.baz' ));

		$this->Store->write( 'foo', 12 );
		$this->assertEquals( 12, $this->Store->read( 'foo' ));
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

		$this->Store->writeAll( $data );
		$this->assertEquals( $data, $this->Store->readAll( ));
	}



	/**
	 *
	 */

	public function testRead( ) {

		$this->assertEquals( $this->data['foo'], $this->Store->read( 'foo' ));
		$this->assertEquals( $this->data['foo']['bar'], $this->Store->read( 'foo.bar' ));
	}



	/**
	 *
	 */

	public function testReadAll( ) {

		$this->assertEquals( $this->data, $this->Store->readAll( ));
	}



	/**
	 *
	 */

	public function testDelete( ) {

		$this->Store->delete( 'foo.bar' );
		$this->assertFalse( $this->Store->has( 'foo.bar' ));

		$this->Store->delete( 'foo' );
		$this->assertFalse( $this->Store->has( 'foo' ));
	}
}
