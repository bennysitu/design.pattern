<?php

namespace github\bennysitu\designpattern\observer;

abstract class Observer {

	public function __construct( Subject $subject ) {
		$subjct->attach( $this );
	}

	public function update( Subject $subject ) {
		if ( $subject->getState() && method_exists( $this, 'updatePost' . ucfirst( $subject->getState() )  )  ) {
			call_user_func( array( $this, 'updatePost' . ucfirst( $subject->getState() ) ), array( $subject ) );
		}		
	}

}
