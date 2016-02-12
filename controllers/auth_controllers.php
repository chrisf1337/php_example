<?php
require_once('base_controller.php');
require_once('models/user.php');

class LoginController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->templateVars['test'] = 'abcdfe';
    $this->templateVars['loginError'] = False;
  }

  function getRender() {
    require_once('views/login.php');
  }

  function post() {
    $user = User::find($_POST['username']);
    if (is_null($user) || !password_verify($_POST['password'], $user->password)) {
      $this->templateVars['loginError'] = True;
    } else {
      $_SESSION['user'] = $user;
      header('Location: /php_example_mvc/');
    }
  }
}

class LogoutController extends BaseController {
  function get() {
    $_SESSION['user'] = NULL;
    header('Location: /php_example_mvc/');

  }
}

class RegisterController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->templateVars['test'] = 'abcdfe';
    $this->templateVars['registerError'] = False;
  }

  function post() {
    $user = User::create($_POST['username'], $_POST['password']);
    if (is_null($user)) {
      $this->templateVars['registerError'] = True;
    } else {
      $_SESSION['user'] = $user;
      header('Location: /php_example_mvc/');
    }
  }

  function getRender() {
    require_once('views/register.php');
  }
}
?>
