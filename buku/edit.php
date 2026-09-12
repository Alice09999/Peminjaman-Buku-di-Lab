<?php

require '../config/koneksi.php';

$id=$_GET['id'];

$data=
mysqli_query(
$koneksi,
"SELECT * FROM buku
WHERE id_buku='$id'"
);

$row=
mysqli_fetch_assoc(
$data
);

if(
isset(
$_POST['update']
)
){

mysqli_query(

$koneksi,

"

UPDATE buku

SET

kode_buku='$_POST[kode]',
judul='$_POST[judul]',
penulis='$_POST[penulis]',
stok='$_POST[stok]'

WHERE

id_buku='$id'

"

);

header(
"Location:index.php"
);

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Edit Buku — SMARTLAB</title>

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
    <h1 class="sl-page-title" style="font-size: 28px; margin-bottom: 8px;">Edit Buku</h1>
    <p class="sl-page-desc" style="margin-bottom: 32px;">Perbarui informasi buku yang sudah tersimpan.</p>

    <div class="sl-card">
        <div class="sl-card-body">
            <form method="POST">

                <div class="sl-form-group">
                    <label for="edit-kode" class="sl-form-label">Kode Buku</label>
                    <input
                        type="text"
                        id="edit-kode"
                        name="kode"
                        value="<?= $row['kode_buku'] ?>"
                        class="sl-form-input"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="edit-judul" class="sl-form-label">Judul Buku</label>
                    <input
                        type="text"
                        id="edit-judul"
                        name="judul"
                        value="<?= $row['judul'] ?>"
                        class="sl-form-input"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="edit-penulis" class="sl-form-label">Penulis</label>
                    <input
                        type="text"
                        id="edit-penulis"
                        name="penulis"
                        value="<?= $row['penulis'] ?>"
                        class="sl-form-input"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="edit-stok" class="sl-form-label">Stok</label>
                    <input
                        type="number"
                        id="edit-stok"
                        name="stok"
                        value="<?= $row['stok'] ?>"
                        class="sl-form-input"
                        required>
                </div>

                <div class="sl-form-actions">
                    <button
                        type="submit"
                        name="update"
                        class="sl-btn sl-btn-primary">
                        <span class="material-symbols-outlined" aria-hidden="true">save</span>
                        Update
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
