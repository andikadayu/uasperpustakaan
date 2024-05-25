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
        $msg = "Peminjaman sudah dihapus";
    }

    switch ($action) {
        case 'delete':
            $title = "Hapus Peminjaman";
            break;
        case 'update':
            $title = 'Ubah Peminjaman';
            break;
        default:
            $title =  'Tambah Peminjaman';
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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group mb-3">
                        <label for="id_buku" class="form-label">Nama Buku</label>
                        <select class="form-select" name="id_buku" id="id_buku" <?php echo $action !=  'create' ? 'disabled' : '' ?> required>
                            <option value="" selected disabled>Pilih Buku</option>
                            <?php
                            $books = $myModels->GetAllBooks();
                            foreach ($books as $book) {
                                $selected = "";
                                if ($action != 'create') {
                                    if ($book->id == $peminjaman->id_buku) {
                                        $selected = "selected";
                                    }
                                }
                                echo "<option value='{$book->id}' {$selected}>{$book->nama}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="datetime-local" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value='<?php
                                                                                                                            echo  $action != "create" ? $peminjaman->tanggal_pinjam : null ?>' <?php echo $action != 'create' ? 'readonly' : '' ?> required>
                    </div>
                    <?php if ($action != "create") { ?>

                        <div class="form-group mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="datetime-local" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value='<?php echo  $action != "create" ? $peminjaman->tanggal_kembali : null ?>' <?php echo $action == 'delete' ? 'readonly' : '' ?>>
                        </div>
                    <?php } ?>
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