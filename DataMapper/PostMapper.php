<?php

namespace designpattern\DataMapper;

class PostMapper {

	protected $dbFactory;

	public function __construct($dbFactory) {
		$this->dbFactory = $dbFactory;
	}

	public function fetchById($postId) {
		$row = $this->dbFactory->selectOne(
			'post',
			array('post_id' => $postId)
		);

		if ($row) {
			return Post::newFromRow($row);
		} else {
			return false;
		}
	}

	public function fetchByAuthor($authorId) {
		$rows = $this->dbFactory->select(
			'post',
			array('author_id')
		);
		$posts = array();

		foreach ($rows as $row) {
			$posts[] = Post::newFromRow($row);
		}
		return $posts;
	}

}
