<?php
    include("vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\Auth;

    $auth = Auth::check();

    $table = new UsersTable(new MySQL);
    $users = $table->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar bg-dark mb-4 navbar-expand navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand">Admin</a>
            <ul class="navbar-nav">
                <li class="nav-item text-white">
                    <a href="profile.php" class="nav-link">
                        <b><?= $auth->name?></b>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="_actions/logout.php" class="nav-link text-danger">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <table class="table table-dark table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th></th>
            </tr>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= $user->phone ?></td>
                    
                    <td>
                        <?php if ($user->role_id == 3) : ?>
                            <span class="badge bg-success">
                                <?= $user->role ?>
                            </span>
                        <?php elseif ($user->role_id == 2) : ?>
                            <span class="badge bg-primary">
                                <?= $user->role ?>
                            </span>
                        <?php else : ?>
                            <span class="badge bg-secondary">
                                <?= $user->role ?>
                            </span>
                        <?php endif ?>
                    </td>
                    <td>
                        <div class="btn-group dropdown">
                            <?php if ($auth->role_id == 3) : ?>
                            <a 
                            href="#"
                            class="btn btn-sm btn-outline-primary dropdown-toggle"
                            data-bs-toggle="dropdown">Role</a>

                            <div class="dropdown-menu">
                                <a 
                                href="_actions/role.php?id=<?= $user->id ?>&role=1"
                                class="dropdown-item">User</a>

                                <a 
                                href="_actions/role.php?id=<?= $user->id ?>&role=2"
                                class="dropdown-item">Manager</a>

                                <a 
                                href="_actions/role.php?id=<?= $user->id ?>&role=3"
                                class="dropdown-item">Admin</a>
                            </div>
                        <?php endif ?>

                        <?php if ($auth->role_id >= 2) : ?>
                            <?php if ($user->suspended) : ?>
                                <a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-warning btn-sm">Ban</a>

                            <?php else : ?>
                                <a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn  btn-outline-warning btn-sm">Ban</a>

                            <?php endif ?>
                            

                            <a href="_actions/delete.php?id=<?= $user->id ?>"
                            class ="btn btn-outline-danger btn-sm">Delete</a>
                        </div>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>