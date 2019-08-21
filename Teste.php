<?php
function __autoload($class_name) {
    require_once $class_name . '.php';
}
$user = new User('localhost', 'root', '', 'libraslab');
$user->updateUser(14, "aaa@aaa", "tati","12345");
$user->getAll();
print_r($user->users);