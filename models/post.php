<?php
require_once(__DIR__ . '/../connection.php');
require_once('user.php');

class Post implements JsonSerializable {
  public $op;
  public $subject;
  public $body;
  public $time;
  public $postId;
  public $id;  // string

  function __construct($id, $postId, $op, $subject, $body, $time) {
    $this->op = $op;
    $this->subject = $subject;
    $this->body = $body;
    $this->id = $id;
    $this->postId = $postId;
    $this->time = $time;
  }

  function jsonSerialize() {
    return [
      'op' => $this->op,
      'subject' => $this->subject,
      'body' => $this->body,
      'id' => $this->id,
      'postId' => $this->postId,
      'time' => $this->time->__toString()
    ];
  }

  static function find($postId) {
    $db = Db::getInstance();
    $result = $db->posts->findOne(['_id' => new MongoId($postId)]);
    if (is_null($result)) {
      return NULL;
    }
    return new Post((string)$result['_id'], $result['id'],
      new User($result['op']['id'], $result['op']['username']),
      $result['subject'], $result['body'], $result['time']);
  }

  static function create(User $op, $subject, $body) {
    $db = Db::getInstance();
    $currentId = $db->postid->findOne()['id'];
    $currentId++;
    $db->postid->update(['id' => $currentId - 1], ['id' => $currentId]);
    $time = new MongoDate();
    $insert = [
      'op' => $op,
      'subject' => $subject,
      'body' => $body,
      'time' => $time,
      'id' => $currentId
    ];
    $db->posts->insert($insert);
    $postId = $insert['_id']->__toString();
    return new Post($postId, $currentId, $op, $subject, $body, $time);
  }
}

class Thread implements JsonSerializable {
  public $posts;
  public $subject;
  public $firstPostPostId;

  function __construct($firstPostPostId, $subject, $posts) {
    $this->firstPostPostId = $firstPostPostId;
    $this->subject = $subject;
    $this->posts = $posts;
  }

  static function find($firstPostPostId) {
    $db = Db::getInstance();
    $result = $db->threads->findOne(['firstPostPostId' => $firstPostPostId]);
    if (is_null($result)) {
      return NULL;
    }
    return new Thread($result['firstPostPostId'], $result['subject'], $result['posts']);
  }

  static function findMostRecent($n) {
    $db = Db::getInstance();
    $threadsCursor = $db->threads->find()->sort(['_id' => -1])->limit($n);
    $array = [];
    foreach ($threadsCursor as $threadObject) {
      array_push($array, new Thread($threadObject['firstPostPostId'], $threadObject['subject'],
                                    $threadObject['posts']));
    }
    return $array;
  }

  static function create(User $op, $subject, $body) {
    $db = Db::getInstance();
    $post = Post::create($op, $subject, $body);
    $insert = [
      'firstPostPostId' => $post->postId,
      'subject' => $subject,
      'posts' => [$post->id],
    ];
    $db->threads->insert($insert);
    return new Thread($post->id, $subject, [$post]);
  }

  function addReply($post) {
    $db = Db::getInstance();
    array_push($this->posts, $post->id);
    $db->threads->update(['firstPostPostId' => $this->firstPostPostId],
                         ['$set' => ['posts' => $this->posts]]);
    var_dump(Thread::find($this->firstPostPostId));
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
