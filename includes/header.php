<?php
$current_page = basename(dirname($_SERVER['PHP_SELF']));
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../assets/css/smartlab.css" rel="stylesheet">

<nav class="sl-navbar" role="navigation" aria-label="Main navigation">
    <div class="sl-navbar-inner">
        <a href="../dashboard/" class="sl-brand" aria-label="SMARTLAB Home">
            <div class="sl-brand-icon">
                <span class="material-symbols-outlined" aria-hidden="true">auto_stories</span>
            </div>
            <div class="sl-brand-text">
                <span class="sl-brand-name">SMARTLAB</span>
                <span class="sl-brand-sub">Laboratorium Software</span>
            </div>
        </a>

        <ul class="sl-nav-links">
            <li><a href="../dashboard/" class="<?= $current_page == 'dashboard' ? 'active' : '' ?>">
                <span class="material-symbols-outlined" aria-hidden="true">dashboard</span> Dashboard
            </a></li>
            <li><a href="../buku/" class="<?= $current_page == 'buku' ? 'active' : '' ?>">
                <span class="material-symbols-outlined" aria-hidden="true">menu_book</span> Data Buku
            </a></li>
            <li><a href="../mahasiswa/" class="<?= $current_page == 'mahasiswa' ? 'active' : '' ?>">
                <span class="material-symbols-outlined" aria-hidden="true">school</span> Mahasiswa
            </a></li>
            <li><a href="../peminjaman/" class="<?= $current_page == 'peminjaman' ? 'active' : '' ?>">
                <span class="material-symbols-outlined" aria-hidden="true">assignment_turned_in</span> Peminjaman
            </a></li>
        </ul>

        <div class="sl-nav-right">
            <?php if(isset($_SESSION['nama'])): ?>
            <div class="sl-admin-info">
                <div class="sl-admin-avatar">
                    <span class="material-symbols-outlined" aria-hidden="true">person</span>
                </div>
                <span><?= $_SESSION['nama']; ?></span>
            </div>
            <?php endif; ?>
            <a href="../auth/logout.php" class="sl-btn-logout" aria-label="Logout">
                <span class="material-symbols-outlined" aria-hidden="true">logout</span> Logout
            </a>
        </div>

        <button class="sl-hamburger" aria-label="Open menu" aria-expanded="false">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>
</nav>

<div class="sl-mobile-overlay"></div>
<div class="sl-mobile-menu" role="navigation" aria-label="Mobile navigation">
    <?php if(isset($_SESSION['nama'])): ?>
    <div style="padding: 12px 16px; margin-bottom: 8px; border-bottom: 1px solid var(--surface-border);">
        <div style="font-size: 13px; color: var(--text-muted);">Logged in as</div>
        <div style="font-size: 15px; font-weight: 600; color: var(--text-primary);"><?= $_SESSION['nama']; ?></div>
    </div>
    <?php endif; ?>
    <a href="../dashboard/" class="<?= $current_page == 'dashboard' ? 'active' : '' ?>">
        <span class="material-symbols-outlined" aria-hidden="true">dashboard</span> Dashboard
    </a>
    <a href="../buku/" class="<?= $current_page == 'buku' ? 'active' : '' ?>">
        <span class="material-symbols-outlined" aria-hidden="true">menu_book</span> Data Buku
    </a>
    <a href="../mahasiswa/" class="<?= $current_page == 'mahasiswa' ? 'active' : '' ?>">
        <span class="material-symbols-outlined" aria-hidden="true">school</span> Mahasiswa
    </a>
    <a href="../peminjaman/" class="<?= $current_page == 'peminjaman' ? 'active' : '' ?>">
        <span class="material-symbols-outlined" aria-hidden="true">assignment_turned_in</span> Peminjaman
    </a>
    <a href="../auth/logout.php" style="color: var(--error); margin-top: 8px; border-top: 1px solid var(--surface-border); padding-top: 16px;">
        <span class="material-symbols-outlined" aria-hidden="true">logout</span> Logout
    </a>
</div>

<div class="sl-main">
