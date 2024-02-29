<?php

session_start();

if(isset($_SESSION['level'])){
    if($_SESSION['level'] == '1'){
        header("location:administrator/index.php");
    }
    if($_SESSION['level'] == '2'){
        header("location:petugas/index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="assets/bootstrap-5.3.2/dist/css/bootstrap.css">
</head> 

<style>

    .container{
        width: 100vh;
        height: 100vh;
    }

    .banner {
        width: 100%;
    }

    @media (min-width:1000px) {
        .banner {
            width: 600px;
        }
    }

</style>

<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card">
            <h3 class="text-center mt-5"><span class="text-primary">S</span>ilahkan <span class="text-primary">M</span>asukan <span class="text-primary">U</span>sername <span class="text-primary">D</span>an <span class="text-primary">P</span>assword</h3>
            <div class="pb-lg-5 content d-flex flex-column flex-lg-row justify-content-around align-items-center">
                <div class="content-1 order-2 order-lg-1">
                    <div class="card-body">
                        <?php
                        if(isset($_GET['pesan'])){
                            if($_GET['pesan'] == 'gagal') {
                                echo "<div class='alert'>Username dan Password tidak sesuai!</div>";
                            }
                        }
                        ?>
                        <form action="cek_login.php" method="POST">
                            <div class="form-group px-5 pb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group px-5">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group mt-5 pb-3">
                                <button class="btn btn-primary form-control" type="submit">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="content-2 order-1 order-lg-2">
                    <img src="assets/login.png" alt="Login Image" class="banner">
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap-5.3.2/dist/js/bootstrap.js"></script>
</body>
</html>