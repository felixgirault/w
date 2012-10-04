<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *
 */

class ConcreteSingleton {

	/**
	 *
	 */

	//use Singleton;



	/**
	 *
	 */

	public $initialized = false;



	/**
	 *
	 */

	protected function _initialize( ) {

		$this->initialized = true;
	}
}



/**
 *	Test case for Singleton.
 */

class SingletonTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Singleton;



	/**
	 *
	 */

	public function setUp( ) {

		$this->Singleton = ConcreteSingleton::instance( );
	}



	/**
	 *
	 */

	public function testConstruct( ) {

		$this->setExpectedException( '\\PHPUnit_Framework_Error' );
		$this->Singleton = new ConcreteSingleton( );
	}



	/**
	 *
	 */

	public function testClone( ) {

		$this->setExpectedException( '\\PHPUnit_Framework_Error' );
		$OtherSingleton = clone $this->Singleton;
	}



	/**
	 *
	 */

	public function testUnserialize( ) {

		$this->setExpectedException( '\\PHPUnit_Framework_Error' );

		$data = serialize( $this->Singleton );
		$this->Singleton = unserialize( $data );
	}



	/**
	 *
	 */

	public function testInstance( ) {

		$this->assertEquals( $this->Singleton, ConcreteSingleton::instance( ));
	}



	/**
	 *
	 */

	public function testInitialize( ) {

		$this->assertTrue( $this->Singleton->initialized );
	}
}
