<?php
require_once('base_controller.php');
class IndexController extends BaseController {
  function __construct() {
    parent::__construct();
    if (!empty($_SESSION['user'])) {
      $this->templateVars['username'] = $_SESSION['user']->username;
    }
  }

  function getRender() {
    require_once('views/home.php');
  }
}
?>
