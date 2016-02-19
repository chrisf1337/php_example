<?php
require_once('connection.php');
require_once('controllers/index_controller.php');
require_once('controllers/auth_controllers.php');
require_once('controllers/thread_controller.php');

session_start();

$url_path = explode('/', rtrim(ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), '/'));
$controller = NULL;
if (count($url_path) === 1) {
  $controller = new IndexController();
} else {
  switch ($url_path[1]) {
    case 'login':
      $controller = new LoginController();
      break;
    case 'logout':
      $controller = new LogoutController();
      break;
    case 'register':
      $controller = new RegisterController();
      break;
    case 'new_thread':
      $controller = new NewThreadController();
      break;
    case 'thread':
      $controller = new ThreadController();
      break;
    case 'reply':
      $controller = new ReplyController();
      break;
  }
}

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $controller->get();
    break;
  case 'POST':
    $controller->post();
    break;
}

$controller->render();
?>
