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
    <style>
    .container {
        height: 100%;
    }
    </style>
</head>

<body>
    <?php
    include('components/navbar.php');
    include 'models/models.php';
    $action = isset($_GET['action']) ? $_GET['action'] : 'create';
    $id = isset($_GET['id']) ? $_GET['id'] : 0;
    $nim = $_SESSION['nim'] ?? 0;
    $msg = " ";
    $title = "Tambah Data Peminjaman";
    $peminjaman = $myModels->GetPeminjamanById($id);
    if (isset($_GET['response'])) {
        $resp = json_decode(base64_decode($_GET["response"]), true);
        $msg = $resp['message'];
    }

    if ($action != 'create' && $peminjaman->isDeleted) {
        $msg = "Buku sudah dihapus";
    }

    switch ($action) {
        case 'delete':
            $title = "Hapus Buku";
            break;
        case 'update':
            $title = 'Ubah Buku';
            break;
        default:
            $title =  'Tambah Buku';
            break;
    };

    ?>

    <div class="container">
        <h4 class="text-center mt-2 "><?php echo $title ?></h4>
        <div class="card mx-auto " style="width: 100%; max-width: 600px;">
            <form action="models/peminjamanprocess.php" method="post" autocomplete="off" autocapitalize="false">
                <div class="card-body">
                    <input type="hidden" name="type" value="<?php echo $action; ?>">
                    <input type="hidden" name="nim" value="<?php echo $nim; ?>">
                    <div class="form-group mb-3">
                        <label for="id_buku" class="form-label">Id Buku</label>
                        <input type="text" class="form-control" id="id_buku" name="id_buku"
                            value='<?php echo  $action != "create" ? $peminjaman->id_buku : null ?>'
                            <?php echo $action == 'delete' ? 'readonly' : '' ?> required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="datetime" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value='<?php 
                            echo  $action != "create" ? $peminjaman->tanggal_pinjam : null ?>'
                            <?php echo $action == 'delete' ? 'readonly' : '' ?> required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="datetime" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                            value='<?php echo  $action != "create" ? $peminjaman->tanggal_kembali : null ?>'
                            <?php echo $action == 'delete' ? 'readonly' : '' ?> required>
                    </div>
                    <?php if ($msg != "") {
                        echo "<small class='text-danger'>$msg</small>";
                    } ?>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="peminjaman.php" class="btn btn-secondary">Batal</a>
                        <?php if ($action != "delete") { ?>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <?php } else { ?>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>


</body>

</html>