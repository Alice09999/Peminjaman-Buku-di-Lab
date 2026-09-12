<?php

session_start();

require '../config/koneksi.php';

if(!isset($_SESSION['login'])){
    header("Location:../auth/login.php");
    exit;
}

$query = mysqli_query(

    $koneksi,

    "

    SELECT

    p.id_pinjam,
    m.nama,
    p.tanggal_pinjam,
    p.tanggal_jatuh_tempo,
    p.status

    FROM peminjaman p

    JOIN mahasiswa m

    ON p.npm = m.npm

    ORDER BY p.id_pinjam DESC

    "

);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Data Peminjaman — SMARTLAB</title>

<?php include "../includes/header.php"; ?>

</head>

<body>

<div class="sl-container">

    <div class="sl-page-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
        <div>
            <div class="sl-page-eyebrow">Manajemen Transaksi</div>
            <h1 class="sl-page-title">Data Peminjaman</h1>
            <p class="sl-page-desc">Pantau aktivitas peminjaman dan pengembalian buku.</p>
        </div>
        <div class="sl-page-actions">
            <a href="../laporan/pdf/cetak_peminjaman.php" target="_blank" class="sl-btn sl-btn-secondary">
                <span class="material-symbols-outlined" aria-hidden="true">picture_as_pdf</span>
                Download PDF
            </a>
            <a href="tambah.php" class="sl-btn sl-btn-primary">
                <span class="material-symbols-outlined" aria-hidden="true">add</span>
                Tambah Peminjaman
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
                            <th>Mahasiswa</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if(mysqli_num_rows($query) > 0): ?>

                        <?php while($row = mysqli_fetch_assoc($query)) : ?>

                        <tr>
                            <td><?= $row['id_pinjam']; ?></td>
                            <td style="font-weight: 500;"><?= $row['nama']; ?></td>
                            <td><?= $row['tanggal_pinjam']; ?></td>
                            <td><?= $row['tanggal_jatuh_tempo']; ?></td>

                            <td>
                                <?php if($row['status'] == 'Dipinjam'){ ?>
                                <span class="sl-badge sl-badge-borrowed">
                                    <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 14px;">schedule</span>
                                    Dipinjam
                                </span>
                                <?php } else { ?>
                                <span class="sl-badge sl-badge-returned">
                                    <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 14px;">check_circle</span>
                                    Dikembalikan
                                </span>
                                <?php } ?>
                            </td>

                            <td>
                                <?php if($row['status'] == 'Dipinjam'){ ?>
                                <a
                                    href="kembali.php?id=<?= $row['id_pinjam']; ?>"
                                    class="sl-btn sl-btn-primary sl-btn-sm"
                                    onclick="return confirm('Yakin buku dikembalikan?')"
                                    aria-label="Kembalikan buku pinjaman <?= $row['nama']; ?>">
                                    <span class="material-symbols-outlined" aria-hidden="true">assignment_return</span>
                                    Kembalikan
                                </a>
                                <?php } else { ?>
                                <button
                                    class="sl-btn sl-btn-sm"
                                    disabled
                                    style="background: var(--success-bg); color: var(--success); border: 1px solid rgba(74,103,65,0.15); cursor: not-allowed; opacity: 0.7;">
                                    <span class="material-symbols-outlined" aria-hidden="true">check</span>
                                    Selesai
                                </button>
                                <?php } ?>
                            </td>
                        </tr>

                        <?php endwhile; ?>

                        <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <div class="sl-empty">
                                    <span class="material-symbols-outlined" aria-hidden="true">assignment</span>
                                    <div class="sl-empty-title">Belum ada data peminjaman</div>
                                    <div class="sl-empty-desc">Buat transaksi peminjaman pertama.</div>
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
