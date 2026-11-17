<?php

date_default_timezone_set('Asia/Jakarta');

$host = "localhost";
$user = "root";
$password = "";
$database = "db_peminjaman_buku_lab";

$koneksi = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if (!$koneksi) {
    die("Koneksi gagal : " . mysqli_connect_error());
}