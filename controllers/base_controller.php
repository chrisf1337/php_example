<?php
class BaseController {
  public $templateVars;

  function __construct() {
    $this->templateVars = [];
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

?>
