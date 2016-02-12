<?php
$username1 = 'chrisf';
$password1 = 'abc123';
$username2 = 'test';
$password2 = "passpasswordword";

$hash1 = password_hash($password1, PASSWORD_DEFAULT);
$hash2 = password_hash($password2, PASSWORD_DEFAULT);

$m = new MongoClient();
$db = $m->php_example;
$users = $db->users;

$users->drop();
$users->createIndex(["username" => 1], ["unique" => true]);
$result = $users->batchInsert([["username" => $username1,
                                "password" => $hash1],
                               ["username" => $username2,
                                "password" => $hash2]]);
print_r($result);
?>
