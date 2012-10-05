<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for Observable.
 */

class ObservableTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Observable;



	/**
	 *
	 */

	public $Observer;



	/**
	 *
	 */

	public function setUp( ) {

		$this->Observable = new ConcreteObservable( );
		$this->Observer = $this->getMock( '\\fg\\w\\Pattern\\ConcreteObserver' );
	}



	/**
	 *
	 */

	public function testAddObserver( ) {


	}



	/**
	 *
	 */

	public function testRemoveObserver( ) {


	}
}
