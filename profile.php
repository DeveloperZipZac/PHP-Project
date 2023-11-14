<?php
    // session_start();
    // $login = isset($_SESSION['user']);

    // if(!$login) {
    //     header("location: index.php");
    //     exist();
    // }

    include("vendor/autoload.php");

    use Helpers\Auth;

    $auth = Auth::check();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="js/bootstrap.bundle.min.js">
</head>
<body>
    <div class="container" style="max-width: 800px">
        <h1 class="h3 my-4">Profile</h1>

        <?php if(isset($_GET['error'])) :?>
            <div class="alert alert-warning">
                Unable to upload
            </div>
        <?php endif ?>
        
        <?php if($auth->photo) : ?>
            <img src="_actions/photos/<?= $auth->photo ?>" alt="Profile Photo"
            width="300" class="img-thumbnail">
        <?php endif ?>

        <form action="_actions/upload.php" method="post"
            enctype="multipart/form-data" class="input-group my-4">
            <input type="file" name="photo" class="form-control">
            <button class="btn btn-secondary">Upload</button>
        </form>
        
        <ul class="list-group mb-4">
            <li class="list-group-item">Name: <?= $auth->name ?></li>
            <li class="list-group-item">Email: <?= $auth->email ?></li>
            <li class="list-group-item">Phone: <?= $auth->phone ?></li>
            <li class="list-group-item">Address: <?= $auth->address ?></li>
        </ul>
        <a href="_actions/logout.php" class="ms-1 text-danger">Logout</a>
        <a href="admin.php" class="ms-2">Manage User</a>
    </div>
</body>
</html>