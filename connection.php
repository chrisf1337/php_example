<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $m = new MongoClient();
        self::$instance = $m->php_example;
      }
      return self::$instance;
    }
  }
?>
