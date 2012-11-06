<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;



/**
 *	A basic visitable object.
 *
 *	@package fg.w.Pattern
 */

abstract class Visitable {

	/**
	 *	Accepts a visitor.
	 *
	 *	@param Visitor $Visitor Visitor visiting the object.
	 */

	public function accept( Visitor $Visitor ) {

		$Visitor->visit( $this );
	}
}
