<?php

include("../vendor/autoload.php");

use Libs\Database\MySQL;
use Libs\Database\UsersTable;
use Helpers\HTTP;
use Helpers\Auth;

$name = $_FILES['photo']['name'];
$tmp = $_FILES['photo']['tmp_name'];
$type = $_FILES['photo']['type'];

$auth = Auth::check();

if($type == "image/jpeg" or $type == "image/png") {
    move_uploaded_file($tmp, "photos/$name");

    $table = new UsersTable(new MySQL);
    $table->updatePhoto($auth->id, $name);

    $auth->photo = $name;

    HTTP::redirect("/profile.php");
} else {
    HTTP::redirect("/profile.php", "error=type");
}