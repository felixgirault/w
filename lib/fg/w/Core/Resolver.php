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

	public function __construct( array $elements ) {

		foreach ( $elements as $name => $dependencies ) {
			if ( !isset( $this->_nodes[ $name ])) {
				$this->_nodes[ $name ] = new Node( array( 'name' => $name ));
			}

			if ( !is_array( $dependencies )) {
				$dependencies = array( $dependencies );
			}

			foreach ( $dependencies as $dependency ) {
				if ( !isset( $this->_nodes[ $dependency ])) {
					$this->_nodes[ $dependency ] = new Node( array( 'name' => $dependency ));
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

		if ( !$Node->property( 'visited', false )) {
			$Node->setProperty( 'visited', true );

			foreach ( $Node as $Child ) {
				self::_visit( $Child );
			}

			$this->_sorted[ ] = $Node->property( 'name' );
		}
	}
}
