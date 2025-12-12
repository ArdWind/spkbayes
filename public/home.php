<?php
// ...\spkbayes\public\home.php (REVISI)

// Variabel default
$APP_NAME = "SPK Bayes";
$BASE_URL_ADMINLTE = "./adminlte/"; // Asumsi folder adminlte berada di root public/
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= $APP_NAME ?> | Halaman Utama</title>

  <link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <link
    rel="stylesheet"
    href="<?= $BASE_URL_ADMINLTE ?>plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>dist/css/adminlte.min.css" />
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <nav
      class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="index.php?page=home" class="navbar-brand">
          <i class="fas fa-microchip mr-2 text-primary"></i>
          <span class="brand-text font-weight-light"><b><?= $APP_NAME ?></b></span>
        </a>

        <button
          class="navbar-toggler order-1"
          type="button"
          data-toggle="collapse"
          data-target="#navbarCollapse"
          aria-controls="navbarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item">
              <a href="admin.php?page=login" class="nav-link btn btn-sm btn-outline-primary px-3">
                <i class="fas fa-sign-in-alt"></i> Login
              </a>
            </li>
            <li class="nav-item">
              <a href="admin.php?page=daftar" class="nav-link btn btn-sm btn-primary ml-2 px-3">
                <i class="fas fa-user-plus"></i> Daftar
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-12 text-center">
              <h1 class="m-0 text-dark">
                Sistem Pendukung Keputusan <small>Metode Naive Bayes</small>
              </h1>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container">
          <div class="row">

            <div class="col-lg-6">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0"><i class="fas fa-chart-pie mr-2"></i> Apa itu SPK Bayes?</h5>
                </div>
                <div class="card-body">
                  <p class="card-text">
                    Sistem ini dirancang untuk mengevaluasi efektivitas kegiatan ekstrakurikuler (ekskul) menggunakan Algoritma **Naive Bayes Classifier**.
                  </p>
                  <p>
                    Metode ini mengandalkan probabilitas berdasarkan data historis untuk memprediksi apakah suatu ekskul cenderung **Sangat Efektif (SE)**, **Efektif (E)**, atau **Perlu Evaluasi (PE)** di masa depan.
                  </p>
                  <a href="admin.php?page=login" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Masuk ke Aplikasi</a>
                </div>
              </div>
            </div>

            <div class="col-lg-6">
              <div class="card card-info card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0"><i class="fas fa-list-ol mr-2"></i> Kriteria yang Digunakan</h5>
                </div>
                <div class="card-body">
                  <p>Model ini menggunakan lima (5) kriteria utama yang dihitung dari data masukan:</p>
                  <ul>
                    <li>**X1:** Persentase Anggota Aktif</li>
                    <li>**X2:** Persentase Absensi Kehadiran</li>
                    <li>**X3:** Status Prestasi (Ada/Tidak Ada Piala)</li>
                    <li>**X4:** Modus Kepuasan Peserta</li>
                    <li>**X5:** Tipe Pembina (Bersertifikat/Guru Sekolah/Alumni)</li>
                  </ul>
                  <a href="admin.php?page=daftar" class="btn btn-default"><i class="fas fa-user-plus"></i> Daftar Akun Siswa</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <footer class="main-footer">
      <strong>Copyright &copy; <?= date('Y') ?> <?= $APP_NAME ?>.</strong>
      All rights reserved.
    </footer>
  </div>
  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>dist/js/adminlte.min.js"></script>
</body>

</html>