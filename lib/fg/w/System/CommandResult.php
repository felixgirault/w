<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\System;



/**
 *	Holds informations about executed commands.
 *
 *	@package fg.w.System
 */

class CommandResult {

	/**
	 *	Executed command.
	 *
	 *	@var string
	 */

	public $command = '';



	/**
	 *	Execution status.
	 *
	 *	@var int
	 */

	public $status = -1;



	/**
	 *	Command output lines.
	 *
	 *	@var array
	 */

	public $output = array( );



	/**
	 *	Command output lines.
	 *
	 *	@var array
	 */

	public $errors = array( );



	/**
	 *	Returns if the execution was succesful.
	 *	This method doesn't guarantee that the execution went fine, but it will
	 *	be right most of the time (with programs that follow standards).
	 *
	 *	@return boolean True if it was, otherwise false.
	 */

	public function isSuccess( ) {

		return ( $this->status == 0 );
	}
}
