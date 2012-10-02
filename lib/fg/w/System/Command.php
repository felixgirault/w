<?php

/**
 *	@author Félix Girault <felix.girault@gmail.com>
 *	@license FreeBSD License (http://opensource.org/licenses/BSD-2-Clause)
 */

namespace fg\w\System;



/**
 *	An interface to execute commands.
 *
 *	@package fg.w.System
 */

class Command {

	/**
	 *	Standard streams.
	 */

	const stdin = 0;
	const stdout = 1;
	const stderr = 2;



	/**
	 *	Command name.
	 *
	 *	@var string
	 */

	protected $_name = '';



	/**
	 *	Assignment operator.
	 *
	 *	@var string
	 */

	protected $_assignment = '';



	/**
	 *	Constructs a command with the given name.
	 *
	 *	@param string $name Command name.
	 *	@param string $assignment An assignment character that will be used to
	 *		associate long options and their values. It is generally a space
	 *		or an equals sign.
	 */

	public function __construct( $name, $assignment = ' ' ) {

		$this->_name = $name;
		$this->_assignment = $assignment;
	}



	/**
	 *	Returns if the command is available on the system, relying on the
	 *	'command' utility, which should be installed on most systems.
	 *
	 *	@return boolean True if it is available, otherwise false.
	 */

	public function exists( ) {

		$Command = new self( 'command' );
		$Result = $Command->execute( array( '-v', $this->_name ));

		return $Result->isSuccess( );
	}



	/**
	 *	Executes the command with the given options.
	 *
	 *	@param array $options Command options.
	 *	@param string $stdin Optional content to pass through stdin.
	 *	@return CommandResult Informations about the executed command.
	 */

	public function execute( array $options = array( ), $stdin = '' ) {

		$Result = new CommandResult( );
		$Result->command = $this->_build( $options );

		$streams = array(
			self::stdin => array( 'pipe', 'r' ),
			self::stdout => array( 'pipe', 'w' ),
			self::stderr => array( 'pipe', 'w' )
		);

		$process = proc_open( $Result->command, $streams, $pipes );

		if ( is_resource( $process )) {
			if ( !empty( $stdin )) {
				fwrite( $pipes[ self::stdin ], $stdin );
			}

			fclose( $pipes[ self::stdin ]);

			$Result->output = stream_get_contents( $pipes[ self::stdout ]);
			fclose( $pipes[ self::stdout ]);

			$Result->errors = stream_get_contents( $pipes[ self::stderr ]);
			fclose( $pipes[ self::stderr ]);

			$Result->status = proc_close( $process );
		}

		return $Result;
	}



	/**
	 *	Returns an executable command line from the given options.
	 *
	 *	@param array $options Command options.
	 *	@return string Command line.
	 */

	protected function _build( array $options ) {

		$command = $this->_name;

		foreach ( $options as $key => $value ) {
			$command .= ' ';

			if ( is_string( $key )) {
				$command .= $key . $this->_assignment;
			}

			$command .= $value;
		}

		return $command;
	}
}
