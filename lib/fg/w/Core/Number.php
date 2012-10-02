<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w;



/**
 *	Number utilities.
 *
 *	@package fg.w
 */

class Number {

	/**
	 *
	 */

	public static function bound( $min, $value, $max ) {

		if ( $value < $min ) {
			return $min;
		}

		if ( $value > $max ) {
			return $max;
		}

		return $value;
	}
}
