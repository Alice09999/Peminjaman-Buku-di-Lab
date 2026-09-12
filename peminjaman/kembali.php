<?php

require '../config/koneksi.php';

$id = $_GET['id'];

/* Ambil buku yang dipinjam */

$data = mysqli_query(

    $koneksi,

    "

    SELECT id_buku

    FROM detail_peminjaman

    WHERE id_pinjam='$id'

    "

);

$row = mysqli_fetch_assoc($data);

/* Ubah status menjadi dikembalikan */

mysqli_query(

    $koneksi,

    "

    UPDATE peminjaman

    SET status='Dikembalikan'

    WHERE id_pinjam='$id'

    "

);

/* Tambah stok buku */

if($row){

    mysqli_query(

        $koneksi,

        "

        UPDATE buku

        SET stok = stok + 1

        WHERE id_buku='$row[id_buku]'

        "

    );

}

header("Location:index.php");
exit;

?>