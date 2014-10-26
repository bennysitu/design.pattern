<?php

namespace designpattern\observer;

/**
 * Abstract subject entity that publishes event
 */
abstract class Subject {

	/**
	 * The state of the subject
	 *
	 * @string
	 */
	protected $state;

	/**
	 * The list of observers that listens to the subject
	 *
	 * @var Observer
	 */
	protected $observers;

	/**
	 * Initialize the observer list
	 */
	public function __construct() {
		$this->observers = array();
	}

	/**
	 * Get the subject state
	 *
	 * @return string
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Set the subject state and notify all observers
	 *
	 * @param string
	 */
	public function SetState( $state ) {
		$this->state = $state;
		$this->notify();
	}

	/**
	 * Notify all observers
	 */
	public function notify() {
		foreach ( $this->observers as $observers ) {
			$observers->update( $this );
		}
	}

	/**
	 * Attach an observer to the subject
	 *
	 */
	public function attach( Observer $observer ) {
		$index = array_search( $observer, $this->observers );
		if ( $index === false ) {
			$this->observers[] = $observer;
		}
	}

	/**
	 * Detach an observer from the subject
	 */
	public function detach( Observer $observer ) {
		$index = array_search( $observer, $this->observers );
                if ( $index !== false ) {
                        unset( $this->observers[$index] );
                }
	}
}
