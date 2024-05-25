<?php

class Siswa
{
    public int $id;
    public string $nama;
    public string $nim;

    public function __construct(int $id, string $nama, string $nim)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->nim = $nim;
    }
}

class Books
{
    public int $id;
    public string $nama;
    public string $penulis;
    public string $tanggal_terbit;
    public bool $isDeleted;

    public function __construct($id, $nama, $penulis, $tanggal_terbit, $isDeleted)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->penulis = $penulis;
        $this->tanggal_terbit = $tanggal_terbit;
        $this->isDeleted = $isDeleted;
    }
}

class Peminjaman
{
    public int $id;
    public string $nim;
    public int $id_buku;
    public string $nama_buku;
    public string $tanggal_pinjam;
    public string|null $tanggal_kembali;
    public bool $isDeleted;

    public function __construct($id, $nim, $id_buku, $nama_buku, $tanggal_pinjam, $tanggal_kembali, $isDeleted)
    {
        $this->id = $id;
        $this->nim = $nim;
        $this->id_buku = $id_buku;
        $this->nama_buku = $nama_buku;
        $this->tanggal_pinjam = $tanggal_pinjam;
        $this->tanggal_kembali = $tanggal_kembali;
        $this->isDeleted = $isDeleted;
    }
}

class GlobalResponse
{
    public int $status;
    public string $message;
    public $data;

    public function __construct(int $status, string $message, $data)
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }
}
