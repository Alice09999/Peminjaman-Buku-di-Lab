<?php

session_start();

require '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM mahasiswa ORDER BY npm ASC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Mahasiswa — SMARTLAB</title>

<?php include "../includes/header.php"; ?>

</head>

<body>

<div class="sl-container">

    <div class="sl-page-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
        <div>
            <div class="sl-page-eyebrow">Manajemen Pengguna</div>
            <h1 class="sl-page-title">Data Mahasiswa</h1>
            <p class="sl-page-desc">Kelola data mahasiswa yang terdaftar dalam sistem peminjaman buku.</p>
        </div>
        <div class="sl-page-actions">
            <a href="../laporan/pdf/cetak_mahasiswa.php" target="_blank" class="sl-btn sl-btn-secondary">
                <span class="material-symbols-outlined" aria-hidden="true">picture_as_pdf</span>
                Download PDF
            </a>
            <a href="tambah.php" class="sl-btn sl-btn-primary">
                <span class="material-symbols-outlined" aria-hidden="true">add</span>
                Tambah Mahasiswa
            </a>
        </div>
    </div>

    <div class="sl-card">
        <div class="sl-card-body" style="padding: 0;">
            <div class="sl-table-wrap">
                <table class="sl-table">
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Prodi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if(mysqli_num_rows($data) > 0): ?>

                    <?php while($row = mysqli_fetch_assoc($data)) : ?>

                        <tr>
                            <td><code style="background: var(--bg-secondary); padding: 2px 8px; border-radius: 3px; font-size: 13px;"><?= $row['npm']; ?></code></td>
                            <td style="font-weight: 500;"><?= $row['nama']; ?></td>
                            <td><?= $row['kelas']; ?></td>
                            <td style="color: var(--text-secondary);"><?= $row['prodi']; ?></td>
                            <td>
                                <div class="sl-actions">
                                    <a
                                        href="edit.php?npm=<?= $row['npm']; ?>"
                                        class="sl-btn sl-btn-secondary sl-btn-sm"
                                        aria-label="Edit <?= $row['nama']; ?>">
                                        <span class="material-symbols-outlined" aria-hidden="true">edit</span>
                                        Edit
                                    </a>

                                    <a
                                        href="hapus.php?npm=<?= $row['npm']; ?>"
                                        class="sl-btn sl-btn-destructive sl-btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        aria-label="Hapus <?= $row['nama']; ?>">
                                        <span class="material-symbols-outlined" aria-hidden="true">delete</span>
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <div class="sl-empty">
                                    <span class="material-symbols-outlined" aria-hidden="true">school</span>
                                    <div class="sl-empty-title">Belum ada data mahasiswa</div>
                                    <div class="sl-empty-desc">Tambahkan mahasiswa pertama ke dalam sistem.</div>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include "../includes/footer.php"; ?>

</body>
</html>
