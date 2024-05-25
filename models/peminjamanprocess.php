<?php
session_start();
include 'models.php';

$nim = $_SESSION["nim"] ?? null;
$type = $_POST["type"] ?? null;
$id = $_POST["id"] ?? 0;
$id_buku = $_POST["id_buku"] ?? null;
$tanggal_pinjam = $_POST["tanggal_pinjam"] ?? null;
$tanggal_kembali = $_POST["tanggal_kembali"] ?? null;

if ($nim == null) {
    header("Location:../login.php");
}

if ($type == "create") {
    $status = $myModels->AddPeminjaman($nim, $id_buku, $tanggal_pinjam);
    if ($status->status == 200) {
        header("Location:../index.php");
    } else {
        $response = base64_encode(json_encode($status));
        header("Location:../form_peminjaman.php?response=$response");
    }
} else if ($type == "update") {
    $status = $myModels->UpdatePeminjaman($id, $tanggal_kembali);
    if ($status->status == 200) {
        header("Location:../index.php");
    } else {
        $response = base64_encode(json_encode($status));
        header("Location:../form_peminjaman.php?response=$response");
    }
} else if ($type == 'delete') {
    $status = $myModels->DeletePeminjaman($id);
    if ($status->status == 200) {
        header("Location:../index.php");
    } else {
        $response = base64_encode(json_encode($status));
        header("Location:../form_peminjaman.php?response=$response");
    }
}
