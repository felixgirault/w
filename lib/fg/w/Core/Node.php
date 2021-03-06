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

class Node extends \fg\w\Pattern\Visitable implements \IteratorAggregate {

	/**
	 *	Parent node.
	 *
	 *	@var Node
	 */

	protected $_Parent = null;



	/**
	 *	Child nodes.
	 *
	 *	@var array
	 */

	protected $_children = array( );



	/**
	 *	Custom properties.
	 *
	 *	@var array
	 */

	protected $_properties = array( );



	/**
	 *	Constructs a node with the given properties and parent.
	 *
	 *	@param array $properties Node properties.
	 *	@param Node $Parent Parent node.
	 */

	public function __construct( array $properties = array( ), Node $Parent = null ) {

		$this->setProperties( $properties );
		$this->setParent( $Parent );
	}



	/**
	 *	Destroys the node and all of its children.
	 */

	public function __destruct( ) {

		foreach ( $this->_children as $Children ) {
			unset( $Children );
		}
	}



	/**
	 *	Clones the node and all of its children.
	 */

	public function __clone( ) {

		$this->_children = clone $this->_children;
	}



	/**
	 *	Returns the value of the property with the given name.
	 *
	 *	@throws OutOfBoundsException if the property doesn't exists.
	 *	@param string $name Property name.
	 *	@return mixed Property value.
	 */

	public function __get( $name ) {

		if ( !array_key_exists( $name, $this->_properties )) {
			throw new \OutOfBoundsException( "The '$name' property does not exist." );
		}

		return $this->_properties[ $name ];
	}



	/**
	 *	Sets the value of a property.
	 *
	 *	@param string $name Property name.
	 *	@param mixed $value Property value.
	 */

	public function __set( $name, $value ) {

		$this->_properties[ $name ] = $value;
	}



	/**
	 *
	 */

	public function getIterator( ) {

		return new \ArrayIterator( $this->_children );
	}



	/**
	 *	Returns if a property with the given name exists.
	 *
	 *	@param string $name Property name.
	 *	@return boolean Whether the property exists or not.
	 */

	public function hasProperty( $name ) {

		return array_key_exists( $name, $this->_properties );
	}



	/**
	 *	Returns a property.
	 *
	 *	@param string $name Property name.
	 *	@param mixed $default Value to return if the property doesn't exists.
	 *	@return mixed Property value.
	 */

	public function property( $name, $default = null ) {

		if ( $this->hasProperty( $name )) {
			return $this->_properties[ $name ];
		}

		return $default;
	}



	/**
	 *	Returns all properties.
	 *
	 *	@return array Properties.
	 */

	public function properties( ) {

		return $this->_properties;
	}



	/**
	 *
	 */

	public function setProperty( $name, $value ) {

		$this->_properties[ $name ] = $value;
	}



	/**
	 *
	 */

	public function setProperties( array $properties ) {

		$this->_properties = $properties;
	}



	/**
	 *
	 */

	public function hasParent( ) {

		return ( $this->_Parent !== null );
	}



	/**
	 *	Returns the node's parent.
	 *
	 *	@return Node Parent node.
	 */

	public function parent( ) {

		return $this->_Parent;
	}



	/**
	 *	Sets the node parent.
	 *
	 *	@param Node $Parent New parent.
	 */

	public function setParent( Node $Parent = null ) {

		if (( $Parent === $this ) || ( $Parent === $this->_Parent )) {
			return;
		}

		if ( $this->hasParent( )) {
			$this->_Parent->removeChild( $this );
		}

		$this->_Parent = $Parent;

		if ( $this->hasParent( )) {
			$this->_Parent->addChild( $this );
		}
	}



	/**
	 *
	 */

	public function findParents( array $properties ) {

		$found = array( );

		if ( $this->hasParent( )) {
			$found = $this->_Parent->findParents( $properties );
			$diff = array_diff_assoc( $properties, $this->_Parent->_properties );

			if ( empty( $diff )) {
				$found[ ] = $this->_Parent;
			}
		}

		return $found;
	}



	/**
	 *
	 */

	public function hasChildren( ) {

		return !empty( $this->_children );
	}



	/**
	 *	Returns the node's children.
	 *
	 *	@param array Children.
	 */

	public function children( ) {

		return $this->_children;
	}



	/**
	 *	Returns how many children the node has.
	 *
	 *	@return int Child count.
	 */

	public function childCount( ) {

		return count( $this->_children );
	}



	/**
	 *
	 */

	public function findChildren( array $properties ) {

		$found = array( );

		foreach ( $this->_children as $Child ) {
			$found = array_merge( $found, $Child->findChildren( $properties ));
			$diff = array_diff_assoc( $properties, $Child->_properties );

			if ( empty( $diff )) {
				$found[ ] = $Child;
			}
		}

		return $found;
	}



	/**
	 *	Adds the given node to the node's children.
	 *
	 *	@param Node Child node to add.
	 */

	public function addChild( Node $Child ) {

		if (( $Child === $this ) || ( $Child->_Parent === $this )) {
			return;
		}

		if ( !in_array( $Child, $this->_children )) {
			$Child->_Parent = $this;
			$this->_children[ ] = $Child;
		}
	}



	/**
	 *	Removes the given node from the node's children.
	 *
	 *	@param Node Child node to remove.
	 */

	public function removeChild( Node $Child ) {

		if ( $Child->_Parent !== $this ) {
			return;
		}

		$Child->_Parent = null;
		$index = array_search( $Child, $this->_children );

		if ( $index !== false ) {
			unset( $this->_children[ $index ]);
		}
	}



	/**
	 *	Returns if the node has any sibling.
	 *
	 *	@return boolean Whether the node has siblings or not.
	 */

	public function hasSiblings( ) {

		return ( $this->_Parent->childCount > 1 );
	}



	/**
	 *	Returns the node siblings.
	 *
	 *	@return array Siblings.
	 */

	public function siblings( ) {

		$siblings = $this->_Parent->children( );
		$index = array_search( $this, $siblings );

		unset( $siblings[ $index ]);
		return $siblings;
	}



	/**
	 *	Detaches the node from the tree by attaching all it's children to it's
	 *	parent.
	 */

	public function detach( ) {

		foreach ( $this->_children as $Child ) {
			$Child->setParent( $this->_Parent );
		}

		if ( $this->hasParent( )) {
			$this->_Parent->removeChild( $this );
		}
	}



	/**
	 *	Returns the depth of the node, i.e. the length of the path from the
	 *	root to the node.
	 *
	 *	@return integer Node depth.
	 */

	public function depth( ) {

		return $this->hasParent( )
			? $this->_Parent->depth( ) + 1
			: 0;
	}



	/**
	 *	Returns the height of the node, i.e. the longest downward path to a leaf.
	 *
	 *	@return integer Node height.
	 */

	public function height( ) {

		$height = 0;

		foreach ( $this->_children as $Child ) {
			if ( $Child->height( ) > $height ) {
				$height = $Child->height( );
			}
		}

		return $height;
	}



	/**
	 *	Returns the size of the node, i.e. the number of descendants it has
	 *	including itself.
	 *
	 *	@return integer Node size.
	 */

	public function size( ) {

		$size = 1;

		foreach ( $this->_children as $Child ) {
			$size += $Child->size( );
		}

		return $size;
	}
}
