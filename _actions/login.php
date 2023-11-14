<?php

// session_start();
include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;


$email = $_POST['email'];
$password = $_POST['password'];

$table = new UsersTable(new MySQL);
$user = $table->findByEmailAndPassword($email, $password);

if($user) {
    if($user->suspended) {
        HTTP::redirect('/index.php', 'suspended=true');
    }

    session_start();
    $_SESSION['user'] = $user;
    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/index.php", "incorrect=login");
}

// if($email == "admin@gmail.com" and $password == "password") {
//     $_SESSION['user'] = ['name' => 'Admin'];
//     header("location: ../profile.php");
// } else {
//     header("location: ../index.php?incorrect=login");
// }