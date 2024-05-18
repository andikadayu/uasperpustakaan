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
            return new GlobalResponse(400, "Login Failed", null);
        }
    }

    public function RegisterSiswa(string $nim, string $nama, string $password): string
    {
        $sql = "INSERT INTO $this->siswaTable VALUES (null, '$nim', '$nama', md5('$password'))";
        $result = mysqli_query($this->koneksi, $sql);
        if ($result) {
            return "true";
        } else {
            return "false";
        }
    }

    public function GetAllBooks(): array | null
    {
        $sql = "SELECT * FROM $this->bukuTable";
        $result = mysqli_query($this->koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $books = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $books[] = $row;
            }
            return $books;
        } else {
            return null;
        }
    }
}

$myModels = new Models();
