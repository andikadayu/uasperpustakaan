<?php
session_start();
if (!isset($_SESSION['login']) == true) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Buku</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <?php include('components/navbar.php'); ?>
    <div class="container mt-2">
        <h4>Data Peminjam Buku</h4>

        <a href="form_peminjaman.php?action=create" class="btn btn-success btn-sm">Tambah Data</a>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nim</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali </th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'models/models.php';
                $nim = $_SESSION['nim'] ?? 0;
                $no = 1;
                $books = $myModels->GetAllPeminjaman($nim);
                foreach ($books as $key => $data) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $data->nim . "</td>";
                    echo "<td>" . $data->nama_buku . "</td>";
                    echo "<td>" . $data->tanggal_pinjam . "</td>";
                    echo "<td>" . $data->tanggal_kembali . "</td>";
                    echo "<td><a href='form_peminjaman.php?action=update&id=" . $data->id . "' class='btn btn-primary btn-sm'>Edit</a> <a href='form_peminjaman.php?action=delete&id=" . $data->id . "' class='btn btn-danger btn-sm'>Hapus</a></td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

</body>

</html>