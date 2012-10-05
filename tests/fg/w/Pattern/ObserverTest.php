<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for Observer.
 */

class ObserverTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Observer;



	/**
	 *
	 */

	public $Observable;



	/**
	 *
	 */

	public function setUp( ) {

		$this->Observer = new ConcreteObserver( );
		$this->Observable = $this->getMock( '\\fg\\w\\Pattern\\ConcreteObservable' );
	}



	/**
	 *
	 */

	public function testObserve( ) {

		$this->Observable
			->expects( $this->once( ))
			->method( 'addObserver' )
			->with( $this->equalTo( $this->Observer ));

		$this->Observer->observe( $this->Observable );
	}



	/**
	 *
	 */

	public function testStopObserving( ) {

		$this->Observable
			->expects( $this->once( ))
			->method( 'removeObserver' )
			->with( $this->equalTo( $this->Observer ));

		$this->Observer->observe( $this->Observable );
	}
}
