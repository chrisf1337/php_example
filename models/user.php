<?php
class User {
  public $username;
  public $password;

  function __construct($username, $password) {
    $this->username = $username;
    $this->password = $password;
  }

  static function find($username) {
    $db = Db::getInstance();
    $user = $db->users->findOne(['username' => $username]);
    if (is_null($user)) {
      return NULL;
    }
    return new User($user['username'], $user['password']);
  }

  static function create($username, $password) {
    $db = Db::getInstance();
    if (!empty(self::find($username))) {
      return NULL;
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $result = $db->users->insert([
        'username' => $username,
        'password' => $hash
      ]);
      return new User($username, $hash);
    }
  }
}
?>
