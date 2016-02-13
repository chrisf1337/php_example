<h1>Login</h1>
<div class="login-form">
  <form action="/php_example/login" method="post">
    <div class="login-form-elem">Username: <input type="text" name="username"></div>
    <div class="login-form-elem">Password: <input type="password" name="password"></div>
    <div class="button-holder"><input type="submit" value="Submit"></div>
  </form>
</div>

<?php
if ($this->context['loginError']) {
?>
<div><?php echo $this->context['loginErrorMessage']; ?></div>
<?php
}
?>
