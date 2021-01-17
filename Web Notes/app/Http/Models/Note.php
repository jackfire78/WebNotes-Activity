<?php

namespace App\Http\Models;

class Note {
	private $username;
	private $content;
	
	public function __construct($username, $content) {
		$this->username = $username;
		$this->content = $content;
	}
	
	public function getUsername() {
		return $this->username;
	}
	public function setUsername($USERNAME){
		$this->username=$USERNAME;
	}
	
	public function getContent() {
		return $this->content;
	}
	public function setContent($CONTENT){
		$this->content=$CONTENT;
	}

}

