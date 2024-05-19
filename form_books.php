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
    $msg = "";
    $title = "Tambah Buku";
    $book = $myModels->GetBookById($id);
    if (isset($_GET['response'])) {
        $resp = json_decode(base64_decode($_GET["response"]), true);
        $msg = $resp['message'];
    }

    if ($action != 'create' && $book->isDeleted) {
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
            <form action="models/bookprocess.php" method="post" autocomplete="off" autocapitalize="false">
                <div class="card-body">
                    <input type="hidden" name="action" value="<?php echo $action; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="form-group mb-3">
                        <label for="nama" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="nama" name="nama" value='<?php echo  $action != "add" ? $book->nama : null ?>' <?php echo $action == 'delete' ? 'readonly' : '' ?> required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" value='<?php echo  $action != "add" ? $book->penulis : null ?>' <?php echo $action == 'delete' ? 'readonly' : '' ?> required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="tanggal_terbit" class="form-label">Tanggal Terbit</label>
                        <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" value='<?php echo  $action != "add" ? $book->tanggal_terbit : null ?>' <?php echo $action == 'delete' ? 'readonly' : '' ?> required>
                    </div>

                    <?php if ($msg != "") {
                        echo "<small class='text-danger'>$msg</small>";
                    } ?>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="books.php" class="btn btn-secondary">Batal</a>
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