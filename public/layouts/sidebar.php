<?php
// ...\spkbayes\public\layouts\sidebar.php

// Variabel dari header.php
$current_role = $_SESSION['user_role'] ?? 'unknown';

// Fungsi untuk cek kelas aktif
function is_active($target)
{
    global $page;
    return ($page === $target) ? 'active' : '';
}
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="admin.php?page=dashboard" class="brand-link">
        <i class="nav-icon fas fa-cogs ml-3"></i>
        <span class="brand-text font-weight-light">SPK Bayes</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">User: <?= $_SESSION['user_nama'] ?? 'Guest' ?></a>
                <span class="badge badge-info"><?= strtoupper($current_role) ?></span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header">NAVIGASI UTAMA</li>

                <li class="nav-item">
                    <a href="admin.php?page=dashboard" class="nav-link <?= is_active('dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if ($current_role == 'admin' || $current_role == 'guru'): ?>
                    <li class="nav-header">SISTEM PENDUKUNG KEPUTUSAN</li>

                    <li class="nav-item">
                        <a href="admin.php?page=form_input" class="nav-link <?= is_active('form_input') ?>">
                            <i class="nav-icon fas fa-edit"></i>
                            <p>Input Data Evaluasi</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin.php?page=list_results" class="nav-link <?= is_active('list_results') ?>">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Prediksi</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($current_role == 'admin'): ?>
                    <li class="nav-header">ADMINISTRASI</li>
                    <li class="nav-item">
                        <a href="admin.php?page=data_latih" class="nav-link <?= is_active('data_latih') ?>">
                            <i class="nav-icon fas fa-database"></i>
                            <p>Data Latih (Historical)</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="admin.php?page=data_probabilitas" class="nav-link <?= is_active('data_probabilitas') ?>">
                            <i class="nav-icon fas fa-percent"></i>
                            <p>Matriks Probabilitas</p>
                        </a>
                    </li>
                <?php endif;
                ?>
                <li class="nav-header">AKUN</li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>