<?php

require '../config/koneksi.php';

if(isset($_POST['simpan'])){

    $nama_cover = '';

    if(
        isset($_FILES['cover']) &&
        $_FILES['cover']['name'] != ''
    ){

        $nama_cover =
            time() . "_" .
            $_FILES['cover']['name'];

        move_uploaded_file(
            $_FILES['cover']['tmp_name'],
            "../uploads/cover/" . $nama_cover
        );

    }

    mysqli_query(

        $koneksi,

        "

        INSERT INTO buku

        (

        kode_buku,
        judul,
        penulis,
        stok,
        cover

        )

        VALUES

        (

        '$_POST[kode]',
        '$_POST[judul]',
        '$_POST[penulis]',
        '$_POST[stok]',
        '$nama_cover'

        )

        "

    );

    header("Location:index.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Buku — SMARTLAB</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/smartlab.css" rel="stylesheet">

</head>

<body style="background: var(--bg-primary);">

<div style="max-width: 640px; margin: 0 auto; padding: 48px 24px;">

    <a href="index.php" style="display: inline-flex; align-items: center; gap: 4px; font-size: 13px; color: var(--text-muted); margin-bottom: 24px; text-decoration: none;">
        <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 18px;">arrow_back</span>
        Kembali ke Data Buku
    </a>

    <div class="sl-page-eyebrow">Koleksi Buku</div>
    <h1 class="sl-page-title" style="font-size: 28px; margin-bottom: 8px;">Tambah Buku Baru</h1>
    <p class="sl-page-desc" style="margin-bottom: 32px;">Tambahkan koleksi buku baru ke laboratorium software.</p>

    <div class="sl-card">
        <div class="sl-card-body">
            <form method="POST" enctype="multipart/form-data">

                <div class="sl-form-group">
                    <label for="input-kode" class="sl-form-label">Kode Buku</label>
                    <input
                        type="text"
                        id="input-kode"
                        name="kode"
                        class="sl-form-input"
                        placeholder="Masukkan kode buku"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-judul" class="sl-form-label">Judul Buku</label>
                    <input
                        type="text"
                        id="input-judul"
                        name="judul"
                        class="sl-form-input"
                        placeholder="Masukkan judul buku"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-penulis" class="sl-form-label">Penulis</label>
                    <input
                        type="text"
                        id="input-penulis"
                        name="penulis"
                        class="sl-form-input"
                        placeholder="Masukkan nama penulis"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-stok" class="sl-form-label">Stok</label>
                    <input
                        type="number"
                        id="input-stok"
                        name="stok"
                        class="sl-form-input"
                        placeholder="Masukkan jumlah stok"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-cover" class="sl-form-label">Cover Buku</label>
                    <input
                        type="file"
                        id="input-cover"
                        name="cover"
                        class="sl-form-file"
                        accept="image/*">
                </div>

                <div class="sl-form-actions">
                    <button
                        type="submit"
                        name="simpan"
                        class="sl-btn sl-btn-primary">
                        <span class="material-symbols-outlined" aria-hidden="true">save</span>
                        Simpan
                    </button>

                    <a
                        href="index.php"
                        class="sl-btn sl-btn-secondary">
                        <span class="material-symbols-outlined" aria-hidden="true">close</span>
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>

</body>
</html>
