<?php

session_start();

require '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query(
    $koneksi,
    "SELECT * FROM buku ORDER BY id_buku DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Buku — SMARTLAB</title>

<?php include "../includes/header.php"; ?>

</head>

<body>

<div class="sl-container">

    <div class="sl-page-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
        <div>
            <div class="sl-page-eyebrow">Manajemen Koleksi</div>
            <h1 class="sl-page-title">Data Buku</h1>
            <p class="sl-page-desc">Kelola seluruh koleksi buku yang tersedia di Laboratorium Software.</p>
        </div>
        <div class="sl-page-actions">
            <a href="../laporan/pdf/cetak_buku.php" target="_blank" class="sl-btn sl-btn-secondary">
                <span class="material-symbols-outlined" aria-hidden="true">picture_as_pdf</span>
                Download PDF
            </a>
            <a href="tambah.php" class="sl-btn sl-btn-primary">
                <span class="material-symbols-outlined" aria-hidden="true">add</span>
                Tambah Buku
            </a>
        </div>
    </div>

    <div class="sl-card">
        <div class="sl-card-body" style="padding: 0;">
            <div class="sl-table-wrap">
                <table class="sl-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cover</th>
                            <th>Kode</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if(mysqli_num_rows($data) > 0): ?>

                    <?php while($row = mysqli_fetch_assoc($data)) : ?>

                        <tr>
                            <td><?= $row['id_buku']; ?></td>

                            <td>
                                <?php if(!empty($row['cover'])){ ?>
                                <img
                                    src="../uploads/cover/<?= $row['cover']; ?>"
                                    class="sl-cover-thumb"
                                    alt="Cover <?= $row['judul']; ?>">
                                <?php }else{ ?>
                                <div class="sl-cover-empty">
                                    <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 20px;">image</span>
                                </div>
                                <?php } ?>
                            </td>

                            <td><code style="background: var(--bg-secondary); padding: 2px 8px; border-radius: 3px; font-size: 13px;"><?= $row['kode_buku']; ?></code></td>

                            <td style="font-weight: 500;"><?= $row['judul']; ?></td>

                            <td style="color: var(--text-secondary);"><?= $row['penulis']; ?></td>

                            <td>
                                <span class="sl-badge sl-badge-stock">
                                    <?= $row['stok']; ?>
                                </span>
                            </td>

                            <td>
                                <div class="sl-actions">
                                    <a
                                        href="edit.php?id=<?= $row['id_buku']; ?>"
                                        class="sl-btn sl-btn-secondary sl-btn-sm"
                                        aria-label="Edit <?= $row['judul']; ?>">
                                        <span class="material-symbols-outlined" aria-hidden="true">edit</span>
                                        Edit
                                    </a>

                                    <a
                                        href="hapus.php?id=<?= $row['id_buku']; ?>"
                                        class="sl-btn sl-btn-destructive sl-btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')"
                                        aria-label="Hapus <?= $row['judul']; ?>">
                                        <span class="material-symbols-outlined" aria-hidden="true">delete</span>
                                        Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7">
                                <div class="sl-empty">
                                    <span class="material-symbols-outlined" aria-hidden="true">menu_book</span>
                                    <div class="sl-empty-title">Belum ada data buku</div>
                                    <div class="sl-empty-desc">Tambahkan buku pertama ke koleksi laboratorium.</div>
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
