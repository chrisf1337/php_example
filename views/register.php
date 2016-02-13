<h1>Register</h1>
<div class="login-form">
  <form action="/php_example/register" method="post">
    <div class="login-form-elem">Username: <input type="text" name="username"></div>
    <div class="login-form-elem">Password: <input type="password" name="password"></div>
    <input type="submit" value="Submit">
  </form>
</div>
<?php
if ($this->context['registerError']) {
?>
<div><?php echo $this->context['registerErrorMessage']; ?></div>
<?php
}
?>
