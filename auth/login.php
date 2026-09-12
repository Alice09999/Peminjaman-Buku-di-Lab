<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — SMARTLAB</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link href="../assets/css/smartlab.css" rel="stylesheet">
</head>

<body>

<div class="sl-login-wrap">

    <div class="sl-login-visual">
        <div class="sl-login-visual-bg" style="background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1200&q=80') center/cover;" role="img" aria-label="Library interior"></div>
        <div class="sl-login-visual-overlay"></div>
        <div class="sl-login-visual-content">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 32px;">
                <div class="sl-brand-icon">
                    <span class="material-symbols-outlined" aria-hidden="true">auto_stories</span>
                </div>
                <div>
                    <div style="font-family: var(--font-heading); font-weight: 800; font-size: 18px; color: #fff;">SMARTLAB</div>
                    <div style="font-size: 11px; color: rgba(255,255,255,0.5);">Laboratorium Software</div>
                </div>
            </div>
            <h2>Sistem Peminjaman Buku Laboratorium Software</h2>
            <p>Kelola koleksi buku, data mahasiswa, dan aktivitas peminjaman secara efisien dalam satu platform terintegrasi.</p>
        </div>
    </div>

    <div class="sl-login-form-side">
        <div class="sl-login-form-inner">
            <div class="sl-login-brand">
                <div class="sl-brand-icon" style="width: 40px; height: 40px;">
                    <span class="material-symbols-outlined" aria-hidden="true" style="font-size: 22px;">auto_stories</span>
                </div>
                <div class="sl-brand-text">
                    <span class="sl-brand-name" style="font-size: 20px;">SMARTLAB</span>
                    <span class="sl-brand-sub">Laboratorium Software</span>
                </div>
            </div>

            <div class="sl-login-badge">Portal Admin</div>
            <h1 class="sl-login-title">Selamat Datang</h1>
            <p class="sl-login-desc">Masuk ke dashboard untuk mengelola sistem peminjaman buku laboratorium.</p>

            <form action="proses_login.php" method="POST">

                <div class="sl-form-group">
                    <label for="login-username" class="sl-form-label">Username</label>
                    <input
                        type="text"
                        id="login-username"
                        name="username"
                        class="sl-form-input"
                        placeholder="Masukkan username"
                        required
                        autocomplete="username">
                </div>

                <div class="sl-form-group">
                    <label for="login-password" class="sl-form-label">Password</label>
                    <div class="sl-password-wrap">
                        <input
                            type="password"
                            id="login-password"
                            name="password"
                            class="sl-form-input"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password">
                        <button type="button" class="sl-password-toggle" aria-label="Toggle password visibility">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                </div>

                <button
                    type="submit"
                    class="sl-btn sl-btn-primary"
                    style="width: 100%; justify-content: center; height: 48px; font-size: 15px; font-weight: 600; margin-top: 8px;">
                    <span class="material-symbols-outlined" aria-hidden="true">login</span>
                    Login
                </button>

            </form>

            <div class="sl-login-secure">
                <span class="material-symbols-outlined" aria-hidden="true">lock</span>
                Sesi aman terenkripsi
            </div>
        </div>
    </div>

</div>

<script src="../assets/js/smartlab.js"></script>

</body>
</html>
