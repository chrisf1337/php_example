<?php
require_once('base_controller.php');
require_once('models/post.php');

class NewThreadController extends JsonResponseController {
  private $response;

  function __construct() {
    parent::__construct();
    $this->response = [];
  }

  function post() {
    if (empty($_POST['body'])) {
      $this->response['error'] = True;
      $this->response['errorMessage'] = 'Body is empty';
      return;
    }
    Thread::create($_SESSION['user'], $_POST['subject'], $_POST['body']);
    $this->response['error'] = False;
  }

  function postRender() {
    echo json_encode($this->response, JSON_PRETTY_PRINT);
  }
}

class ThreadController extends BaseController {
  private $error;

  function __construct() {
    parent::__construct();
    $this->error = False;
    $this->context['posts'] = [];
  }

  function get() {
    if (!empty($_GET['id'])) {
      $thread = Thread::find((int)$_GET['id']);
    }
    if (is_null($thread)) {
      $this->error = True;
      return;
    }
    foreach ($thread->posts as $postId) {
      array_push($this->context['posts'], Post::find($postId));
    }
  }

  function getRender() {
    if ($this->error) {
      require_once('views/error.php');
    } else {
      require_once('views/thread.php');
    }
  }
}

class ReplyController extends JsonResponseController {
  private $response;

  function __construct() {
    parent::__construct();
    $this->response = [];
  }

  function post() {
    if (empty($_POST['body'])) {
      $this->response['error'] = True;
      $this->response['errorMessage'] = 'Body is empty';
      return;
    } else if (empty($_POST['thread'])) {
      $this->response['error'] = True;
      $this->response['errorMessage'] = 'Thread is empty';
      return;
    }

    $thread = Thread::find((int)$_POST['thread']);
    if (is_null($thread)) {
      $this->response['error'] = True;
      $this->response['errorMessage'] = 'Invalid thread id';
      return;
    }

    $reply = Post::create($_SESSION['user'], $_POST['subject'], $_POST['body']);
    $thread->addReply($reply);
    $this->response['error'] = False;
  }

  function postRender() {
    echo json_encode($this->response, JSON_PRETTY_PRINT);
  }
}
?>
