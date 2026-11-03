<?php

require '../config/koneksi.php';

if(
isset(
$_POST['simpan']
)
){

mysqli_query(

$koneksi,

"

INSERT INTO mahasiswa

VALUES

(

'$_POST[nim]',
'$_POST[nama]',
'$_POST[kelas]',
'$_POST[prodi]',
'$_POST[alamat]',
NOW()

)

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

<title>Tambah Mahasiswa — SMARTLAB</title>

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
        Kembali ke Data Mahasiswa
    </a>

    <div class="sl-page-eyebrow">Manajemen Pengguna</div>
    <h1 class="sl-page-title" style="font-size: 28px; margin-bottom: 8px;">Tambah Mahasiswa</h1>
    <p class="sl-page-desc" style="margin-bottom: 32px;">Daftarkan mahasiswa baru ke dalam sistem peminjaman.</p>

    <div class="sl-card">
        <div class="sl-card-body">
            <form method="POST">

                <div class="sl-form-group">
                    <label for="input-nim" class="sl-form-label">NIM</label>
                    <input
                        type="text"
                        id="input-nim"
                        name="nim"
                        class="sl-form-input"
                        placeholder="Masukkan NIM"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-nama" class="sl-form-label">Nama Lengkap</label>
                    <input
                        type="text"
                        id="input-nama"
                        name="nama"
                        class="sl-form-input"
                        placeholder="Masukkan nama lengkap"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-kelas" class="sl-form-label">Kelas</label>
                    <input
                        type="text"
                        id="input-kelas"
                        name="kelas"
                        class="sl-form-input"
                        placeholder="Masukkan kelas"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-prodi" class="sl-form-label">Program Studi</label>
                    <input
                        type="text"
                        id="input-prodi"
                        name="prodi"
                        class="sl-form-input"
                        placeholder="Masukkan program studi"
                        required>
                </div>

                <div class="sl-form-group">
                    <label for="input-alamat" class="sl-form-label">Alamat</label>
                    <input
                        type="text"
                        id="input-alamat"
                        name="alamat"
                        class="sl-form-input"
                        placeholder="Masukkan alamat"
                        required>
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
