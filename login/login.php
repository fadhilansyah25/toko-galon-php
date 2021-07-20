<?php
require '../connection.php';

session_start();

if (isset($_POST['login'])) {
    if ($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
        header("location: ../index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include "../component/meta.php";
    ?>
    <style>
        .col-6 {
            height: 600px;
            width: 100%;
        }

        .col-6:nth-child(1) {
            border-radius: 10px 0px 0px 10px;
            background-color: #ffff00;
        }

        .col-6:nth-child(2) {
            border-radius: 0px 10px 10px 0px;
        }
    </style>
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row shadow" style="border-radius: 10px">
            <div class="col-6 d-flex align-items-center justify-content-center">
                <div class="w-75">
                    <h3><b>Toko Galon dan Gas</b> </h3>
                    <form action="" method="POST" class="mt-5">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control form-control-sm" name="username"
                            placeholder="Username..">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-sm" name="password"
                            placeholder="Password..">
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" name="login">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-6 d-flex align-items-center">
                <img src="./gambar-login.png" alt="water" class="img-fluid">
            </div>
        </div>
    </div>
    <?php
    include '../component/bundle.php';
    ?>
</body>

</html>