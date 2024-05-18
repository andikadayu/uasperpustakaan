<?php

session_start();
include 'models.php';

$type = isset($_POST["type"]) ? $_POST["type"] : null;
$nim = isset($_POST["nim"]) ? $_POST["nim"] : null;
$nama = isset($_POST["nama"]) ? $_POST["nama"] : null;
$password = isset($_POST["password"]) ? $_POST["password"] : null;
$repassword = isset($_POST["repassword"]) ? $_POST["repassword"] : null;

if ($type == "login") {
    $global =  $myModels->LoginSiswa($nim, $password);
    if ($global->status == 200) {
        $_SESSION["login"] = true;
        $_SESSION["nim"] = $nim;
        $_SESSION["nama"] = $global->data->nama;
        header("Location:../index.php");
    } else {
        $response = base64_encode(json_encode($global));
        header("Location:../login.php?response=$response");
    }
} else if ($type == "register") {
} else {
    header("Location:../login.php");
}
