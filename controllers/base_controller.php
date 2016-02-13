<?php
class BaseController {
  public $context;

  function __construct() {
    $this->context = [];
  }

  function get() { }

  function post() { }

  function error() {
    require_once('views/error.php');
  }

  function getRender() {
    $this->error();
  }

  function postRender() {
    $this->error();
  }

  function render() {
    require_once('views/layout.php');
  }
}

class JsonResponseController extends BaseController {
  function render() {
    header('Content-Type: application/json');
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':
        $this->getRender();
        break;
      case 'POST':
        $this->postRender();
        break;
    }
  }
}

?>
