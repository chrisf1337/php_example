<?php
require_once('base_controller.php');
require_once('models/user.php');

class LoginController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->context['test'] = 'abcdfe';
    $this->context['loginError'] = False;
  }

  function getRender() {
    require_once('views/login.php');
  }

  function post() {
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $this->context['loginError'] = True;
      $this->context['loginErrorMessage'] = 'Please enter a username/password.';
      return;
    }
    $user = User::find($_POST['username']);
    if (empty($user) || !password_verify($_POST['password'], $user->getPassword())) {
      $this->context['loginError'] = True;
      $this->context['loginErrorMessage'] = 'Incorrect username/password combination.';
    } else {
      $_SESSION['user'] = $user;
      header('Location: /php_example/');
    }
  }

  function postRender() {
    require_once('views/login.php');
  }
}

class LogoutController extends BaseController {
  function get() {
    $_SESSION['user'] = NULL;
    header('Location: /php_example/');

  }
}

class RegisterController extends BaseController {
  function __construct() {
    parent::__construct();
    $this->context['registerError'] = False;
  }

  function post() {
    if (empty($_POST['username']) || empty($_POST['password'])) {
      $this->context['registerError'] = True;
      $this->context['registerErrorMessage'] = 'Please enter a username/password.';
      return;
    }
    $user = User::create($_POST['username'], $_POST['password']);
    if (is_null($user)) {
      $this->context['registerError'] = True;
      $this->context['registerErrorMessage'] = 'A user with that username already exists.';
    } else {
      $_SESSION['user'] = $user;
      header('Location: /php_example/');
    }
  }

  function getRender() {
    require_once('views/register.php');
  }

  function postRender() {
    require_once('views/register.php');
  }
}
?>
