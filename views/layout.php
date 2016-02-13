<!DOCTYPE html>
<html>
<head>
  <title>Board</title>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>
  <header>
    <a href="/php_example">Home</a>
    <?php if (empty($_SESSION['user'])) { ?>
    <a href="/php_example/login">Login</a>
    <a href="/php_example/register">Register</a>
    <?php } else { ?>
    <a href='/php_example/logout'>Logout</a>
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
