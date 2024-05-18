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
