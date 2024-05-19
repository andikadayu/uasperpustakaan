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
