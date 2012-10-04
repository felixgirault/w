<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;

require_once dirname( dirname( dirname( dirname( __FILE__ ))))
	. DIRECTORY_SEPARATOR . 'bootstrap.php';



/**
 *	Test case for Node.
 */

class NodeTest extends \PHPUnit_Framework_TestCase {

	/**
	 *
	 */

	public $Node = null;



	/**
	 *
	 */

	public function setUp( ) {

		$this->Node = new Node( );
	}



	/**
	 *
	 */

	public function testHasParent( ) {

		$this->assertFalse( $this->Node->hasParent( ));

		$this->Node->setParent( new Node( ));
		$this->assertTrue( $this->Node->hasParent( ));
	}



	/**
	 *
	 */

	public function testParent( ) {

		$this->assertNull( $this->Node->parent( ));

		$Parent = new Node( );
		$this->Node->setParent( $Parent );
		$this->assertEquals( $Parent, $this->Node->parent( ));
	}



	/**
	 *
	 */

	public function testSetParent( ) {

		$Parent = new Node( );
		$this->Node->setParent( $Parent );
		$this->assertContains( $this->Node, $Parent->children( ));

		$NewParent = new Node( );
		$this->Node->setParent( $NewParent );
		$this->assertNotContains( $this->Node, $Parent->children( ));

		$this->Node->setParent( null );
		$this->assertNotContains( $this->Node, $NewParent->children( ));
	}



	/**
	 *
	 */

	public function testHasChildren( ) {

		$this->assertFalse( $this->Node->hasChildren( ));

		$this->Node->addChild( new Node( ));
		$this->assertTrue( $this->Node->hasChildren( ));
	}



	/**
	 *
	 */

	public function testChildren( ) {

		$Child = new Node( );
		$this->Node->addChild( $Child );
		$this->assertContains( $Child, $this->Node->children( ));
	}



	/**
	 *
	 */

	public function testChildCount( ) {

		$this->assertEquals( 0, $this->Node->childCount( ));

		$this->Node->addChild( new Node( ));
		$this->assertEquals( 1, $this->Node->childCount( ));

		$this->Node->addChild( new Node( ));
		$this->assertEquals( 2, $this->Node->childCount( ));
	}



	/**
	 *
	 */

	public function testAddChild( ) {

		$this->Node->addChild( $this->Node );
		$this->assertEmpty( $this->Node->children( ));

		$Child = new Node( );
		$this->Node->addChild( $Child );
		$this->assertContains( $Child, $this->Node->children( ));
		$this->assertEquals( $this->Node, $Child->parent( ));
	}



	/**
	 *
	 */

	public function testRemoveChild( ) {

		$Child = new Node( );
		$this->Node->addChild( $Child );
		$this->Node->removeChild( $Child );
		$this->assertNotContains( $Child, $this->Node->children( ));
		$this->assertNull( $Child->parent( ));
	}



	/**
	 *
	 */

	public function testDetach( ) {

		$Parent = new Node( );
		$Child = new Node( );
		$this->Node->setParent( $Parent );
		$this->Node->addChild( $Child );
		$this->Node->detach( );
		$this->assertEquals( $Parent, $Child->parent( ));
		$this->assertContains( $Child, $Parent->children( ));
	}



	/**
	 *
	 */

	public function testDepth( ) {

		$this->assertEquals( 0, $this->Node->depth( ));

		$GrandParent = new Node( );
		$Parent = new Node( );
		$Parent->setParent( $GrandParent );
		$this->Node->setParent( $Parent );
		$this->assertEquals( 2, $this->Node->depth( ));
	}



	/**
	 *
	 */

	public function testSize( ) {

		$this->assertEquals( 1, $this->Node->size( ));

		$Child = new Node( );
		$Child->addChild( new Node( ));
		$Child->addChild( new Node( ));
		$this->Node->addChild( $Child );
		$this->assertEquals( 4, $this->Node->size( ));
	}
}
