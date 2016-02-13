<?php
class User implements JsonSerializable {
  public $username;
  public $id;

  function __construct($id, $username) {
    $this->username = $username;
    $this->id = $id;
  }

  static function find($username) {
    $db = Db::getInstance();
    $user = $db->users->findOne(['username' => $username]);
    if (is_null($user)) {
      return NULL;
    }
    return new User($user['_id']->__toString(), $user['username']);
  }

  static function create($username, $password) {
    $db = Db::getInstance();
    if (!empty(self::find($username))) {
      return NULL;
    } else {
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $insert = [
        'username' => $username,
        'password' => $hash
      ];
      $result = $db->users->insert($insert);
      return new User($insert['_id']->__toString(), $username);
    }
  }

  function getPassword() {
    $db = Db::getInstance();
    return $db->users->findOne(['username' => $this->username], ['password'])['password'];
  }

  function jsonSerialize() {
    return [
      'username' => $this->username,
      'id' => $this->id
    ];
  }
}
?>
