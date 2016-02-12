<h1>Register</h1>
<form action="/php_example_mvc/register" method="post">
  Username: <input type="text" name="username"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Submit">
</form>
<?php
if ($this->templateVars['registerError']) {
?>
<div>A user with that username already exists.</div>
<?php
}
?>
