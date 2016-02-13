<?php
require_once(__DIR__ . '/../connection.php');

class Post implements JsonSerializable {
  public $op;
  public $body;
  public $time;
  public $postId;
  public $id;

  function __construct($id, $postId, $op, $body, $time) {
    $this->op = $op;
    $this->body = $body;
    $this->id = $id;
    $this->postId = $postId;
    $this->time = $time;
  }

  function jsonSerialize() {
    return [
      'op' => $this->op,
      'body' => $this->body,
      'id' => $this->id,
      'postId' => $this->postId,
      'time' => $this->time->__toString()
    ];
  }

  static function create($op, $body) {
    $db = Db::getInstance();
    $currentId = $db->postid->findOne()['id'];
    $currentId++;
    $db->postid->update(['id' => $currentId - 1], ['id' => $currentId]);
    $time = new MongoDate();
    $insert = [
      'op' => $op,
      'body' => $body,
      'time' => $time,
      'id' => $currentId
    ];
    $db->posts->insert($insert);
    $postId = $insert['_id']->__toString();
    return new Post($postId, $currentId, $op, $body, $time);
  }
}

class Thread implements JsonSerializable {
  public $posts;
  public $subject;
  public $id;

  function __construct($id, $subject, $posts) {
    $this->id = $id;
    $this->subject = $subject;
    $this->posts = $posts;
  }

  static function findMostRecent($n) {
    $db = Db::getInstance();
    $threadsCursor = $db->threads->find()->sort(['_id' => -1])->limit($n);
    $array = [];
    foreach ($threadsCursor as $threadObject) {
      array_push($array, new Thread($threadObject['_id']->__toString(), $threadObject['subject'],
                                    $threadObject['posts']));
    }
    return $array;
  }

  static function create($op, $subject, $body) {
    $db = Db::getInstance();
    $post = Post::create($op, $body);
    $insert = [
      'subject' => $subject,
      'posts' => [$post->id]
    ];
    $db->threads->insert($insert);
    $threadId = $insert['_id']->__toString();
    return new Thread($threadId, $subject, [$post]);
  }

  function jsonSerialize() {
    $posts = [];
    foreach ($this->posts as $post) {
      array_push($posts, $post->jsonSerialize());
    }
    return [
      'subject' => $this->subject,
      'posts' => $posts
    ];
  }
}
?>
