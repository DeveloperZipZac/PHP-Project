<?php

include("vendor/autoload.php");

use Faker\Factory as Faker;
use Libs\Database\MySQL;
use Libs\Database\UsersTable;

$faker = Faker::create();
$table = new UsersTable(new MySQL);

echo "Starting... <br>";
for($i=0; $i<20; $i++) {
    $table->insert([
        "name" => $faker->name,
        "email" => $faker->email,
        "phone" => $faker->phoneNumber,
        "address" => $faker->address,
        "password" => "password",
    ]);
}

echo "Done.";