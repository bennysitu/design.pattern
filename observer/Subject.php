<?php

namespace github\bennysitu\designpattern\observer;

abstract class Subject {

	protected $state;

	protected $observers;

	public function __construct() {
		$this->observers = array();
	}

	public function getState() {
		return $this->state;
	}

	public function SetState( $state ) {
		$this->state = $state;
		$this->notify();
	}

	public function notify() {
		foreach ( $this->observers as $observers ) {
			$observers->update( $this->state );
		}
	}

	public function attach( Observer $observer ) {
		$index = array_search( $observer, $this->observers );
		if ( $index === false ) {
			$this->observers[] = $observer;
		}
	}

	public function detach( Observer $observer ) {
		$index = array_search( $observer, $this->observers );
                if ( $index !== false ) {
                        unset( $this->observers[$index] );
                }
	}
}
