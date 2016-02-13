<?php
require_once('base_controller.php');
require_once('models/post.php');

class IndexController extends BaseController {
  function __construct() {
    parent::__construct();
    if (!empty($_SESSION['user'])) {
      $this->context['username'] = $_SESSION['user']->username;
    }
  }

  function get() {
    $this->context['frontPageThreads'] = Thread::findMostRecent(10);
  }

  function getRender() {
    require_once('views/home.php');
  }
}
?>
