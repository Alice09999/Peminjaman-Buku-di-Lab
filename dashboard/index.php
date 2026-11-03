<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

$total_buku = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM buku")
);

$total_mahasiswa = mysqli_num_rows(
    mysqli_query($koneksi, "SELECT * FROM mahasiswa")
);

$total_pinjam = mysqli_num_rows(
    mysqli_query(
        $koneksi,
        "SELECT * FROM peminjaman WHERE status='Dipinjam'"
    )
);

$keyword = isset($_GET['keyword'])
    ? mysqli_real_escape_string($koneksi,$_GET['keyword'])
    : '';

if($keyword != ''){

    $buku_terbaru = mysqli_query(
        $koneksi,
        "SELECT *
         FROM buku
         WHERE judul LIKE '%$keyword%'
         ORDER BY id_buku DESC"
    );

}else{

    $buku_terbaru = mysqli_query(
        $koneksi,
        "SELECT *
         FROM buku
         ORDER BY id_buku DESC
         LIMIT 6"
    );

}
$riwayat = mysqli_query(
    $koneksi,
    "SELECT p.id_pinjam,
            m.nama,
            p.tanggal_pinjam,
            p.status
     FROM peminjaman p
     JOIN mahasiswa m
     ON p.npm = m.nim
     ORDER BY p.id_pinjam DESC
     LIMIT 5"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard — SMARTLAB</title>

<?php include "../includes/header.php"; ?>

</head>

<body>

<div class="sl-container">

    <div class="sl-hero">
        <div class="sl-hero-bg" role="img" aria-label="Library background"></div>
        <div class="sl-hero-overlay"></div>
        <div class="sl-hero-content">
            <div class="sl-hero-badge">
                <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 14px;">auto_stories</span>
                SMARTLAB
            </div>
            <h1>Temukan dan Kelola Koleksi Buku Laboratorium</h1>
            <p>Halo, <?= $_SESSION['nama']; ?> — Selamat datang di Sistem Peminjaman Buku Laboratorium Software.</p>
            <a href="../buku/" class="sl-btn sl-btn-primary">
                <span class="material-symbols-outlined" aria-hidden="true">menu_book</span>
                Jelajahi Koleksi
            </a>
        </div>
    </div>

    <div class="sl-quick-grid">
        <a href="../buku/" class="sl-quick-card">
            <div class="sl-quick-icon">
                <span class="material-symbols-outlined" aria-hidden="true">menu_book</span>
            </div>
            <div class="sl-quick-title">Data Buku</div>
            <div class="sl-quick-desc">Kelola koleksi buku laboratorium, tambah, edit, dan hapus data buku.</div>
            <div class="sl-quick-arrow">
                Selengkapnya <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </div>
        </a>
        <a href="../mahasiswa/" class="sl-quick-card">
            <div class="sl-quick-icon">
                <span class="material-symbols-outlined" aria-hidden="true">school</span>
            </div>
            <div class="sl-quick-title">Mahasiswa</div>
            <div class="sl-quick-desc">Kelola data mahasiswa yang terdaftar dalam sistem peminjaman.</div>
            <div class="sl-quick-arrow">
                Selengkapnya <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </div>
        </a>
        <a href="../peminjaman/" class="sl-quick-card">
            <div class="sl-quick-icon">
                <span class="material-symbols-outlined" aria-hidden="true">assignment_turned_in</span>
            </div>
            <div class="sl-quick-title">Peminjaman</div>
            <div class="sl-quick-desc">Pantau aktivitas peminjaman dan pengembalian buku laboratorium.</div>
            <div class="sl-quick-arrow">
                Selengkapnya <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </div>
        </a>
    </div>

    <div class="sl-stat-strip">
        <div class="sl-stat-card">
            <div class="sl-stat-icon books">
                <span class="material-symbols-outlined" aria-hidden="true">menu_book</span>
            </div>
            <div>
                <div class="sl-stat-label">Total Buku</div>
                <div class="sl-stat-value"><?= $total_buku; ?></div>
            </div>
        </div>
        <div class="sl-stat-card">
            <div class="sl-stat-icon students">
                <span class="material-symbols-outlined" aria-hidden="true">school</span>
            </div>
            <div>
                <div class="sl-stat-label">Total Mahasiswa</div>
                <div class="sl-stat-value"><?= $total_mahasiswa; ?></div>
            </div>
        </div>
        <div class="sl-stat-card">
            <div class="sl-stat-icon borrowed">
                <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
            </div>
            <div>
                <div class="sl-stat-label">Sedang Dipinjam</div>
                <div class="sl-stat-value"><?= $total_pinjam; ?></div>
            </div>
        </div>
    </div>

    <div class="sl-section">
        <div class="sl-section-header">
            <h2 class="sl-section-title">Cari Buku</h2>
        </div>
        <form method="GET">
            <div class="sl-search-bar">
                <div class="sl-search-input-wrap">
                    <span class="material-symbols-outlined" aria-hidden="true">search</span>
                    <label for="search-keyword" class="visually-hidden" style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);border:0;">Cari judul buku</label>
                    <input
                        type="text"
                        id="search-keyword"
                        name="keyword"
                        class="sl-search-input"
                        placeholder="Cari judul buku..."
                        value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                </div>
                <button type="submit" class="sl-btn sl-btn-primary">
                    <span class="material-symbols-outlined" aria-hidden="true">search</span>
                    Cari
                </button>
            </div>
        </form>
    </div>

    <div class="sl-section">
        <div class="sl-section-header">
            <h2 class="sl-section-title"><?= $keyword != '' ? 'Hasil Pencarian' : 'Koleksi Terbaru'; ?></h2>
            <a href="../buku/" class="sl-btn sl-btn-secondary sl-btn-sm">
                Lihat Semua <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </a>
        </div>

        <?php if(mysqli_num_rows($buku_terbaru) > 0): ?>
        <div class="sl-book-grid">

            <?php while($b = mysqli_fetch_assoc($buku_terbaru)) : ?>

            <div class="sl-book-card">

                <?php if(!empty($b['cover'])){ ?>
                <img
                    src="../uploads/cover/<?= $b['cover']; ?>"
                    class="sl-book-cover"
                    alt="Cover buku <?= $b['judul']; ?>">
                <?php } else { ?>
                <div class="sl-book-cover-empty">
                    <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 40px; color: var(--surface-muted);">menu_book</span>
                </div>
                <?php } ?>

                <div class="sl-book-info">
                    <div class="sl-book-title"><?= $b['judul']; ?></div>
                    <div class="sl-book-author"><?= $b['penulis']; ?></div>
                    <div class="sl-book-meta">
                        <span class="sl-badge sl-badge-stock">
                            <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 14px;">inventory_2</span>
                            Stok: <?= $b['stok']; ?>
                        </span>
                    </div>
                </div>

            </div>

            <?php endwhile; ?>

        </div>
        <?php else: ?>
        <div class="sl-card">
            <div class="sl-empty">
                <span class="material-symbols-outlined" aria-hidden="true">search_off</span>
                <div class="sl-empty-title">Tidak ada buku ditemukan</div>
                <div class="sl-empty-desc">Coba gunakan kata kunci yang berbeda.</div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="sl-section">
        <div class="sl-section-header">
            <h2 class="sl-section-title">Riwayat Peminjaman</h2>
            <a href="../peminjaman/" class="sl-btn sl-btn-secondary sl-btn-sm">
                Lihat Semua <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </a>
        </div>

        <div class="sl-card">
            <div class="sl-card-body" style="padding: 0;">
                <div class="sl-table-wrap">
                    <table class="sl-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mahasiswa</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if(mysqli_num_rows($riwayat) > 0): ?>
                            <?php while($r = mysqli_fetch_assoc($riwayat)) : ?>

                            <tr>
                                <td><?= $r['id_pinjam']; ?></td>
                                <td><?= $r['nama']; ?></td>
                                <td><?= $r['tanggal_pinjam']; ?></td>
                                <td>
                                    <?php if($r['status']=="Dipinjam"){ ?>
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
                            </tr>

                            <?php endwhile; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <div class="sl-empty" style="padding: 32px;">
                                        <span class="material-symbols-outlined" aria-hidden="true">history</span>
                                        <div class="sl-empty-title">Belum ada riwayat peminjaman</div>
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

</div>

<?php include "../includes/footer.php"; ?>

</body>
</html>
