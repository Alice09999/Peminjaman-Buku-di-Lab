<?php

require '../config/koneksi.php';

$mahasiswa=
mysqli_query(
$koneksi,
"SELECT * FROM mahasiswa"
);

$buku=
mysqli_query(
$koneksi,
"SELECT * FROM buku
WHERE stok>0"
);

if(
isset(
$_POST['simpan']
)
){

mysqli_query(

$koneksi,

"

INSERT INTO peminjaman

(

npm,
tanggal_pinjam,
tanggal_jatuh_tempo

)

VALUES

(

'$_POST[npm]',
CURDATE(),
DATE_ADD(
CURDATE(),
INTERVAL 7 DAY
)

)

"

);

$id=
mysqli_insert_id(
$koneksi
);

mysqli_query(

$koneksi,

"

INSERT INTO detail_peminjaman

(

id_pinjam,
id_buku,
jumlah

)

VALUES

(

'$id',
'$_POST[buku]',
1

)

"

);

mysqli_query(

$koneksi,

"

UPDATE buku

SET

stok=stok-1

WHERE

id_buku='$_POST[buku]'

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

<title>Tambah Peminjaman — SMARTLAB</title>

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
        Kembali ke Data Peminjaman
    </a>

    <div class="sl-page-eyebrow">Transaksi Baru</div>
    <h1 class="sl-page-title" style="font-size: 28px; margin-bottom: 8px;">Tambah Peminjaman</h1>
    <p class="sl-page-desc" style="margin-bottom: 32px;">Buat transaksi peminjaman buku baru untuk mahasiswa.</p>

    <div class="sl-card">
        <div class="sl-card-body">
            <form method="POST">

                <div class="sl-form-group">
                    <label for="select-npm" class="sl-form-label">Mahasiswa</label>
                    <select
                        id="select-npm"
                        name="npm"
                        class="sl-form-select"
                        required>
                        <option value="" disabled selected>Pilih mahasiswa</option>
                        <?php
                        while(
                        $m=
                        mysqli_fetch_assoc(
                        $mahasiswa
                        )
                        ):
                        ?>
                        <option value="<?= $m['npm'] ?>">
                            <?= $m['nama'] ?>
                        </option>
                        <?php endwhile ?>
                    </select>
                </div>

                <div class="sl-form-group">
                    <label for="select-buku" class="sl-form-label">Buku</label>
                    <select
                        id="select-buku"
                        name="buku"
                        class="sl-form-select"
                        required>
                        <option value="" disabled selected>Pilih buku</option>
                        <?php
                        while(
                        $b=
                        mysqli_fetch_assoc(
                        $buku
                        )
                        ):
                        ?>
                        <option value="<?= $b['id_buku'] ?>">
                            <?= $b['judul'] ?>
                        </option>
                        <?php endwhile ?>
                    </select>
                </div>

                <div style="padding: 12px 16px; background: var(--bg-secondary); border-radius: var(--radius-sm); margin-bottom: 20px; font-size: 13px; color: var(--text-muted); display: flex; align-items: center; gap: 8px;">
                    <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 18px;">info</span>
                    Tanggal pinjam otomatis hari ini. Jatuh tempo 7 hari setelah peminjaman.
                </div>

                <div class="sl-form-actions">
                    <button
                        type="submit"
                        name="simpan"
                        class="sl-btn sl-btn-primary">
                        <span class="material-symbols-outlined" aria-hidden="true">assignment_turned_in</span>
                        Pinjam
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
