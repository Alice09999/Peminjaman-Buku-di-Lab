<?php

require '../config/koneksi.php';

$npm = $_GET['npm'];

$cek = mysqli_query(
    $koneksi,
    "SELECT * FROM peminjaman WHERE npm='$npm' AND status='Dipinjam'"
);

if (mysqli_num_rows($cek) > 0) {
    echo "
    <script>
        alert('Data mahasiswa tidak dapat dihapus karena masih memiliki peminjaman yang belum dikembalikan.');
        window.location='index.php';
    </script>
    ";
} else {
    mysqli_query(
        $koneksi,
        "DELETE FROM peminjaman WHERE npm='$npm'"
    );
    mysqli_query(
        $koneksi,
        "DELETE FROM mahasiswa WHERE npm='$npm'"
    );
    echo "
    <script>
        alert('Data mahasiswa berhasil dihapus.');
        window.location='index.php';
    </script>
    ";
}


