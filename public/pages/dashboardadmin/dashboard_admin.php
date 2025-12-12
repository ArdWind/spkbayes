<?php
//...\spkbayes\public\pages\dashboardadmin\dashboard_admin.php

// --- Pastikan Variabel Peran Tersedia ---
// Variabel ini di set di admin.php setelah user_logged_in dicek.
$current_role = $_SESSION['user_role'] ?? 'unknown';
$user_name = $_SESSION['user_nama'] ?? 'Pengguna';
?>

<div class="row">
  <div class="col-12">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Selamat Datang, <?= $user_name ?>!</h3>
      </div>
      <div class="card-body">
        <p>Anda saat ini login sebagai <b><?= strtoupper($current_role) ?></b>.</p>
        <p>Menu dan akses yang Anda lihat di sidebar telah disesuaikan dengan peran Anda.</p>

        <hr>

        <?php if ($current_role == 'admin'): ?>
          <div class="alert alert-info">
            <h5><i class="icon fas fa-cogs"></i> Kontrol Sistem</h5>
            Sebagai Administrator, Anda memiliki akses penuh untuk mengelola <b>User</b>, <b>Kriteria</b>, dan menjalankan <b>Perhitungan SPK</b> utama.
          </div>
        <?php elseif ($current_role == 'guru'): ?>
          <div class="alert alert-warning">
            <h5><i class="icon fas fa-chalkboard-teacher"></i> Tugas Utama</h5>
            Fokus utama Anda adalah melakukan <b>Input Data Siswa</b> dan melihat hasil rekomendasi dari Sistem Pendukung Keputusan.
          </div>
        <?php elseif ($current_role == 'siswa'): ?>
          <div class="alert alert-success">
            <h5><i class="icon fas fa-book-reader"></i> Informasi</h5>
            Anda dapat melihat data diri dan <b>Hasil Penilaian</b> Anda yang sudah diinput oleh Guru.
          </div>
        <?php else: ?>
          <p class="text-danger">Akses peran tidak dikenal.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <?php if ($current_role == 'admin'): ?>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-info">
        <div class="inner">
          <h3>150</h3>
          <p>Total User Terdaftar</p>
        </div>
        <div class="icon"><i class="ion ion-person-add"></i></div>
        <a href="admin.php?page=user_management" class="small-box-footer">Kelola User <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>5</h3>
          <p>Kriteria Aktif</p>
        </div>
        <div class="icon"><i class="ion ion-stats-bars"></i></div>
        <a href="admin.php?page=data_kriteria" class="small-box-footer">Lihat Kriteria <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  <?php elseif ($current_role == 'guru'): ?>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>30</h3>
          <p>Jumlah Siswa Dibimbing</p>
        </div>
        <div class="icon"><i class="ion ion-stats-bars"></i></div>
        <a href="admin.php?page=input_siswa" class="small-box-footer">Input Data <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  <?php elseif ($current_role == 'siswa'): ?>
    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>85.5</h3>
          <p>Rata-rata Nilai Anda</p>
        </div>
        <div class="icon"><i class="ion ion-star"></i></div>
        <a href="admin.php?page=lihat_nilai" class="small-box-footer">Detail Nilai <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
  <?php endif; ?>
</div>