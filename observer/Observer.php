<?php

namespace designpattern\observer;

/**
 * Abstract observer entity that act upon subject state change
 */
abstract class Observer {

	/**
	 * @param Subject
	 */
	public function __construct( Subject $subject ) {
		$subject->attach( $this );
	}

	/**
	 * Update when a subject changes its state
	 *
	 * @param Subject
	 */
	public function update( Subject $subject ) {
		$state  = $subject->getState();
		$method = 'updateOn' . ucfirst( $subject->getState() );
		if ( $state && method_exists( $this, $method  )  ) {
			call_user_func_array( array( $this, $method ), array( $subject ) );
		}		
	}

}
