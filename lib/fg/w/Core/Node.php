<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *	An abstract node to build trees.
 *
 *	@package fg.w.Core
 */

class Node implements \IteratorAggregate {

	/**
	 *
	 */

	protected $_Parent = null;



	/**
	 *
	 */

	protected $_children = array( );



	/**
	 *
	 */

	protected $_data = null;



	/**
	 *
	 */

	public function __construct( $data = null, Node $Parent = null ) {

		$this->setParent( $Parent );
	}



	/**
	 *
	 */

	public function __destruct( ) {

		foreach ( $this->_children as $Children ) {
			unset( $Children );
		}
	}



	/**
	 *
	 */

	public function __clone( ) {

		$this->_children = clone $this->_children;
	}



	/**
	 *
	 */

	public function getIterator( ) {

		return new \ArrayIterator( $this->_children );
	}



	/**
	 *
	 */

	public function data( ) {

		return $this->_data;
	}



	/**
	 *
	 */

	public function setData( $data ) {

		$this->_data = $data;
	}



	/**
	 *
	 */

	public function hasParent( ) {

		return ( $this->_Parent !== null );
	}



	/**
	 *
	 */

	public function parent( ) {

		return $this->_Parent;
	}



	/**
	 *
	 */

	public function setParent( Node $Parent = null ) {

		if (( $Parent === $this ) || ( $Parent === $this->_Parent )) {
			return;
		}

		if ( $this->_Parent !== null ) {
			$this->_Parent->_remove( $this );
		}

		$this->_Parent = $Parent;

		if ( $this->_Parent !== null ) {
			$this->_Parent->_add( $this );
		}
	}



	/**
	 *
	 */

	public function hasChildren( ) {

		return !empty( $this->_children );
	}



	/**
	 *
	 */

	public function children( ) {

		return $this->_children;
	}



	/**
	 *
	 */

	public function childCount( ) {

		return count( $this->_children );
	}



	/**
	 *
	 */

	public function addChild( Node $Child ) {

		if (( $Child === $this ) || ( $Child->_Parent === $this )) {
			return;
		}

		if ( !in_array( $Child, $this->_children )) {
			$Child->_Parent = $this;
			$this->_add( $Child );
		}
	}



	/**
	 *
	 */

	protected function _add( Node $Child ) {

		$this->_children[ ] = $Child;
	}



	/**
	 *
	 */

	public function removeChild( Node $Child ) {

		if ( $Child->_Parent === $this ) {
			$Child->_Parent = null;
			$this->_remove( $Child );
		}
	}



	/**
	 *
	 */

	protected function _remove( Node $Child ) {

		$index = array_search( $Child, $this->_children );

		if ( $index !== false ) {
			unset( $this->_children[ $index ]);
		}
	}



	/**
	 *
	 */

	public function hasSiblings( ) {

		return ( $this->_Parent->childCount > 1 );
	}



	/**
	 *
	 */

	public function siblings( ) {

		$siblings = $this->_Parent->children( );
		$index = array_search( $this, $siblings );

		if ( $index !== false ) {
			unset( $siblings[ $index ]);
		}

		return $siblings;
	}



	/**
	 *
	 */

	public function detach( ) {

		foreach ( $this->_children as $Child ) {
			$Child->setParent( $this->_Parent );
		}

		if ( $this->_Parent !== null ) {
			$this->_Parent->removeChild( $this );
		}

		$this->_Parent = null;
	}



	/**
	 *
	 */

	public function depth( ) {

		return ( $this->_Parent === null )
			? 0
			: ( $this->_Parent->depth( ) + 1 );
	}



	/**
	 *
	 */

	public function size( ) {

		$size = 1;

		foreach ( $this->_children as $Child ) {
			$size += $Child->size( );
		}

		return $size;
	}
}
