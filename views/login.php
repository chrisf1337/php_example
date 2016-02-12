<h1>Login</h1>
<form action="/php_example_mvc/login" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Submit">
</form>
<?php
if ($this->templateVars['loginError']) {
?>
<div>User/password combination was incorrect.</div>
<?php
}
?>
