<?php
session_start();
if (!isset($_SESSION['login']) == true) {
    header("location:login.php");
} else {
    header("location:peminjaman.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Peminjaman</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <?php include('components/navbar.php'); ?>
</body>

</html>