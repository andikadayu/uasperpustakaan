<?php
include 'structs.php';
class Models
{
    private $koneksi;
    private $dbHost = "localhost";
    private $dbName = "uas_perpustakaan";
    private $dbUser = "root";
    private $dbPass = "";
    private $bukuTable = "buku";
    private $peminjamanTable = "peminjaman";
    private $siswaTable = "siswa";

    public function __construct()
    {
        $this->koneksi = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        if (!$this->koneksi) {
            die("Koneksi Gagal : " . mysqli_connect_error());
        }
    }

    public function LoginSiswa(string $nim, string $password): GlobalResponse
    {
        $sql = "SELECT * FROM $this->siswaTable WHERE nim = '$nim' AND password = md5('$password')";
        $result = mysqli_query($this->koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $siswa = new Siswa($row["id"], $row["nama"], $row["nim"]);
            $global = new GlobalResponse(200, "Login Success", $siswa);
            return $global;
        } else {
            return new GlobalResponse(400, "nim or password incorrect", null);
        }
    }

    public function RegisterSiswa(string $nim, string $nama, string $password): GlobalResponse
    {
        $sql = "INSERT INTO $this->siswaTable VALUES (null, '$nim', '$nama', md5('$password'))";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            $global = new GlobalResponse(200, "Register Success", null);
            return $global;
        } else {
            return new GlobalResponse(400, "Register Failed", null);
        }
    }

    public function GetAllBooks(): array
    {
        $all_result = array();
        $sql = "SELECT * FROM $this->bukuTable WHERE deleted_at IS NULL";
        $result = mysqli_query($this->koneksi, $sql);

        while ($row = mysqli_fetch_array($result)) {
            $all_result[] = new Books($row['id'], $row['nama'], $row['penulis'], $row['tanggal_terbit'], $row['deleted_at'] != null ? true : false);
        }

        return $all_result;
    }

    public function GetBookById(int $id): Books | null
    {
        if ($id != 0) {
            $sql = "SELECT * FROM $this->bukuTable WHERE id = $id";
            $result = mysqli_query($this->koneksi, $sql);
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                return new Books($row['id'], $row['nama'], $row['penulis'], $row['tanggal_terbit'], $row['deleted_at'] != null ? true : false);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function AddBook(string $nama, string $penulis, string $tanggal_terbit): GlobalResponse
    {
        $sql = "INSERT INTO $this->bukuTable VALUES (null, '$nama', '$penulis', '$tanggal_terbit',now(),now(),null)";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            $global = new GlobalResponse(200, "Add Book Success", null);
            return $global;
        } else {
            return new GlobalResponse(400, "Add Book Failed", null);
        }
    }

    public function UpdateBook(int $id, string $nama, string $penulis, string $tanggal_terbit): GlobalResponse
    {
        $sql = "UPDATE $this->bukuTable SET nama = '$nama', penulis = '$penulis', tanggal_terbit = '$tanggal_terbit',updated_at=now() WHERE id = $id";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            $global = new GlobalResponse(200, "Update Book Success", null);
            return $global;
        } else {
            return new GlobalResponse(400, "Update Book Failed", null);
        }
    }

    public function DeleteBook(int $id): GlobalResponse
    {
        $sql = "UPDATE $this->bukuTable SET deleted_at=now() WHERE id = $id";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            $global = new GlobalResponse(200, "Delete Book Success", null);
            return $global;
        } else {
            return new GlobalResponse(400, "Delete Book Failed", null);
        }
    }

    function AddPeminjaman(string $nim, int $id_buku, string $tanggal_pinjam): GlobalResponse
    {
        $sql = "INSERT INTO $this->peminjamanTable VALUES (null, $nim, $id_buku, '$tanggal_pinjam', null,null)";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            return new GlobalResponse(200, "Add Peminjaman Success", null);
        } else {
            return new GlobalResponse(400, "Add Peminjaman Failed", null);
        }
    }

    public function GetAllPeminjaman($nim): array
    {
        $all_result = array();
        $sql = "SELECT $this->peminjamanTable.*,$this->bukuTable.nama as nama_buku,$this->bukuTable.id as id_buku FROM $this->peminjamanTable JOIN $this->bukuTable ON $this->peminjamanTable.id_buku = $this->bukuTable.id WHERE nim = '$nim' and $this->peminjamanTable.deleted_at is null";
        $result = mysqli_query($this->koneksi, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $all_result[] = new Peminjaman($row['id'], $row['nim'], $row['id_buku'], $row['nama_buku'], $row['tanggal_pinjam'], $row['tanggal_kembali'], $row['deleted_at'] != null ? true : false);
        }
        return $all_result;
    }
    public function GetPeminjamanById(int $id): Peminjaman | null
    {
        if ($id != 0) {
            $sql = "SELECT $this->peminjamanTable.*,$this->bukuTable.nama as nama_buku,$this->bukuTable.id as id_buku FROM $this->peminjamanTable JOIN $this->bukuTable ON $this->peminjamanTable.id_buku = $this->bukuTable.id WHERE $this->peminjamanTable.id = $id";
            $result = mysqli_query($this->koneksi, $sql);
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                return new Peminjaman($row['id'], $row['nim'], $row['id_buku'], $row['nama_buku'], $row['tanggal_pinjam'], $row['tanggal_kembali'], $row['deleted_at'] != null ? true : false);
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    public function UpdatePeminjaman(int $id, string $tanggal_kembali): GlobalResponse
    {
        $sql = "UPDATE $this->peminjamanTable SET tanggal_kembali = '$tanggal_kembali' WHERE id = $id";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            $global = new GlobalResponse(200, "Update Peminjaman Success", null);
            return $global;
        } else {
            return new GlobalResponse(400, "Update Peminjaman Failed", null);
        }
    }

    public function DeletePeminjaman($id): GlobalResponse
    {
        $sql = "UPDATE $this->peminjamanTable SET deleted_at=now() WHERE id = $id";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            $global = new GlobalResponse(200, "Delete Peminjaman Success", null);
            return $global;
        } else {
            return new GlobalResponse(400, "Delete Peminjaman Failed", null);
        }
    }
}

$myModels = new Models();
