<?php
class Post {
  public $op;
  public $body;
  public $time;

  function __construct($op, $body) {
    $this->op = $op;
    $this->body = $body;
  }

  static function create($op, $password) {

  }
}

class Thread {
  public $posts;
}
?>
