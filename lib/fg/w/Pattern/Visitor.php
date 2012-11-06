<?php

/**
 *  @author Félix Girault <felix.girault@gmail.com>
 *  @license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\Pattern;



/**
 *	A basic visitor.
 *
 *	@package fg.w.Pattern
 */

interface Visitor {

	/**
	 *
	 */

	public function accept( Visitable $Visitable );

}
