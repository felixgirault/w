<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Core;



/**
 *
 *
 *	@package fg.w.Core
 */

class Resolver {

	/**
	 *
	 */

	protected $_nodes = array( );



	/**
	 *
	 */

	protected $_sorted = array( );



	/**
	 *
	 */

	public function __construct( array $dependencies ) {

		foreach ( $dependencies as $name => $deps ) {
			if ( !isset( $this->_nodes[ $name ])) {
				$this->_nodes[ $name ] = new Node(
					array(
						'name' => $name,
						'visited' => false
					)
				);
			}

			if ( !is_array( $deps )) {
				$deps = array( $deps );
			}

			foreach ( $deps as $dependency ) {
				if ( !isset( $this->_nodes[ $dependency ])) {
					$this->_nodes[ $dependency ] = new Node( );
				}

				$this->_nodes[ $name ]->addChild( $this->_nodes[ $dependency ]);
			}
		}
	}



	/**
	 *
	 */

	public function resolve( ) {

		$this->_sorted = array( );

		foreach ( $this->_nodes as $Node ) {
			if ( !$Node->hasParent( )) {
				self::_visit( $Node );
			}
		}

		return $this->_sorted;
	}



	/**
	 *
	 */

	protected function _visit( Node &$Node ) {

		if ( !$Node->visited ) {
			$Node->visited = true;

			foreach ( $Node as $Child ) {
				self::_visit( $Child );
			}

			$this->_sorted[ ] = $Node->name;
		}
	}
}
