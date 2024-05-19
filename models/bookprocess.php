<?php
include 'models.php';

$action = $_POST['action'];
$id = $_POST['id'];
$nama = $_POST['nama'];
$penulis = $_POST['penulis'];
$tanggal_terbit = $_POST['tanggal_terbit'];

if ($action == "create") {
    $status = $myModels->AddBook($nama, $penulis, $tanggal_terbit);
    if ($status->status == 200) {
        header("location:../books.php");
    } else {
        $response = base64_encode(json_encode($response));
        header("location:../form_books.php?action=$action&id=$id&response=$response");
    }
} else if ($action == "update") {
    $status = $myModels->UpdateBook($id, $nama, $penulis, $tanggal_terbit);
    if ($status->status == 200) {
        header("location:../books.php");
    } else {
        $response = base64_encode(json_encode($response));
        header("location:../form_books.php?action=$action&id=$id&response=$response");
    }
} else if ($action == 'delete') {
    $status = $myModels->DeleteBook($id);
    if ($status->status == 200) {
        header("location:../books.php");
    } else {
        $response = base64_encode(json_encode($response));
        header("location:../form_books.php?action=$action&id=$id&response=$response");
    }
}
