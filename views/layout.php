<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <header>
    <a href="/php_example_mvc">Home</a>
    <?php if (empty($_SESSION['user'])) { ?>
    <a href="/php_example_mvc/login">Login</a>
    <a href="/php_example_mvc/register">Register</a>
    <?php } else { ?>
    <a href='/php_example_mvc/logout'>Logout</a>
    <?php } ?>
  </header>
  <?php
  switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      $this->getRender();
      break;
    case 'POST':
      $this->postRender();
      break;
  }
  ?>
  <footer>Copyright</footer>
</body>
</html>
