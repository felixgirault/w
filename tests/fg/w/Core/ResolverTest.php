<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for Resolver.
 */

class ResolverTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Resolver = null;



	/**
	 *
	 */

	public function setUp( ) {

		$this->Resolver = new Resolver(
			array(
				'a' => array( 'b', 'd' ),
				'b' => array( 'c', 'e' ),
				'c' => array( 'd', 'e' ),
			)
		);
	}



	/**
	 *
	 */

	public function testResolve( ) {

		$this->assertEquals(
			array( 'd', 'e', 'c', 'b', 'a' ),
			$this->Resolver->resolve( )
		);
	}
}
