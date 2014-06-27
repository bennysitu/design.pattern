<?php

namespace github\designpattern\observer;

require_once( 'Observer.php' );
require_once( 'Subject.php' );


/**
 * An entity that represents a post in a discussion system
 *
 */
class Post {

	protected $postId;
	protected $content;
	protected $author;
	protected $lastModifiedBy;
	protected $publisher;
	protected $title;
	
	public static function create( User $user, $content, PostSubject $publisher ) {
		$post = new Post();
		$post->author = $user;
		$post->postId = rand();
		$post->content = $content;
		$post->publisher = $publisher;
		$post->publisher->setPost( $post );
		return $post;
	}
	
	public function edit( User $user, $content ) {
		// update content
		$this->lastModifiedBy = $user;
		$this->content = $content;
		$this->publisher->setState( 'edit' );
	}

	public function delete( User $user ) {
		// delete the post
		$this->lastModifiedBy = $user;
		$this->publisher->setState( 'delete' );
	}
	
	public function getLastModifiedBy() {
		return $this->lastModifiedBy;	
	}

	public function getPostId() {
		return $this->postId;	
	}

	public function getConent() {
		return $this->content;	
	}

	public function getAuthor() {
		return $this->author;	
	}

}

/**
 * An entity that represents a user
 */
class User {
	protected $userId;
	protected $userName;

	public function __construct( $userId = '' ) {
		// initialize user data
	}

	public static function create( $userName ) {
		$user = new User();
		$user->userName = $userName;
		$user->userId = rand();
		return $user; 
	}

	public function getUserName() {
		return $this->userName;	
	}
}

/**
 * Post Subject
 */
class PostSubject extends Subject {

	protected $post;
	
	public function __construct( Post $post = null ) {
		parent::__construct();
		$this->post = $post;
	}

	public function setPost( Post $post ) {
		$this->post = $post;
	}

	public function getPost() {
		if ( !$this->post ) {
			throw new Exception( 'PostSubject does not have any post' );
		}
		return $this->post;	
	}
}

/**
 * Post Notification observer
 */
class PostNotification extends Observer {
	
	public function updateOnEdit( PostSubject $subject ) {
		echo $subject->getPost()->getLastModifiedBy()->getUserName() . ' edited the post with id ' . $subject->getPost()->getPostId() . "\n";
	}

	public function updateOnDelete( PostSubject $subject ) {
		echo $subject->getPost()->getLastModifiedBy()->getUserName() . ' deleted the post with id ' . $subject->getPost()->getPostId() . "\n";
	}

}


$author = User::create( 'DowJohn' );
$editor = User::create( 'Bsitu' );

$postSubject = new PostSubject();
$postObserver = new PostNotification( $postSubject );

$post = Post::create( $author, 'a new post', $postSubject );
$post->edit( $editor, 'edit the post');
$post->delete( $editor, 'delete the post' );

