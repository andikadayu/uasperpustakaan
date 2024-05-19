<?php
session_start();

if (isset($_SESSION["login"]) == true) {
    header("location:indexp.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <style>
        body,
        html {
            height: 100%;
        }

        .container {
            height: 100%;
        }
    </style>
</head>

<body>
    <?php
    $msg = "";

    if (isset($_GET["response"])) {
        $resp = json_decode(base64_decode($_GET["response"]), true);
        $msg = $resp['message'];
    }
    ?>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card mx-auto my-auto" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form action="models/loginregister.php" method="post" autocomplete="off" autocapitalize="false">
                    <input type="hidden" name="type" value="login">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="number" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <?php if ($msg != "") {
                        echo "<small class='text-danger'>$msg</small>";
                    } ?>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-primary btn-block form-control">Login</button>
                    </div>
                    <div>
                        <small>Belum punya akun? <a href="register.php">Daftar disini</a></small>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</body>

</html>