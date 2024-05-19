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
        <h4>Data Buku</h4>

        <a href="form_books.php?action=create" class="btn btn-success btn-sm">Tambah Data</a>

        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'models/models.php';
                $no = 1;
                $books = $myModels->GetAllBooks();
                foreach ($books as $key => $data) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $data->nama . "</td>";
                    echo "<td>" . $data->penulis . "</td>";
                    echo "<td>" . $data->tanggal_terbit . "</td>";
                    echo "<td><a href='form_books.php?action=update&id=" . $data->id . "' class='btn btn-primary btn-sm'>Edit</a> <a href='form_books.php?action=delete&id=" . $data->id . "' class='btn btn-danger btn-sm'>Hapus</a></td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

</body>

</html>