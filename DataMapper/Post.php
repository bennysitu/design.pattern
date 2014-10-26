<?php
namespace designpattern\DataMapper;

class Post {

	protected $postId;
	protected $author;
	protected $postContent; 

	public function __construct($postId) {
		$this->postId = $postId;
	}

	public static function newFromRow($row) {
		$this->postId = $row->post_id;
		$this->author = User::newFromId($row->author_id);
		$this->postContent = $row->post_content;
	}

	public function getPostId() {

	}

	public function setPostId() {

	}

	public function getAuthor() {

	}

	public function setAuthor() {

	}

	public function getPostContent() {

	}

	public function setPostContent() {

	}

}
