<?php
require_once('base_controller.php');
require_once('models/post.php');

class NewThreadController extends JsonResponseController {
  public $error;
  public $errorMessage;
  public $thread;

  function __construct() {
    parent::__construct();
    $error = False;
  }

  function post() {
    if (empty($_POST['body'])) {
      $error = True;
      $errorMessage = 'Body is empty';
      return;
    }
    $this->thread = Thread::create($_SESSION['user'], $_POST['subject'], $_POST['body']);
  }

  function postRender() {
    echo json_encode($this->thread, JSON_PRETTY_PRINT);
  }
}
?>
