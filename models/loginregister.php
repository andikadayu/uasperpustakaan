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
    if ($password != $repassword) {
        $response = base64_encode(json_encode(new GlobalResponse(400, "invalid password", null)));
        header("Location:../register.php?response=$response");
    } else {
        $global = $myModels->RegisterSiswa($nim, $nama, $password);
        if ($global->status == 200) {
            $_SESSION["login"] = true;
            $_SESSION["nim"] = $nim;
            $_SESSION["nama"] = $global->data->nama;
            header("Location:../index.php");
        } else {
            $response = base64_encode(json_encode($global));
            header("Location:../register.php?response=$response");
        }
    }
} else {
    header("Location:../login.php");
}
