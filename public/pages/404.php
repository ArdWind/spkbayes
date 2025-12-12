<?php
//...\spkbayes\public\pages\404.php

// Variabel $BASE_URL_ADMINLTE diasumsikan tersedia dari admin.php
if (!isset($BASE_URL_ADMINLTE)) {
  $BASE_URL_ADMINLTE = "./adminlte/";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK Bayes | 404 Not Found</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition">

  <section class="content" style="padding-top: 100px;">
    <div class="error-page">
      <h2 class="headline text-warning"> 404</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Ups! Halaman Tidak Ditemukan.</h3>

        <p>
          Kami tidak dapat menemukan halaman yang Anda cari.
          Mungkin Anda bisa kembali ke dashboard atau halaman utama.
        </p>

        <div class="mt-4">
          <a href="admin.php?page=dashboard" class="btn btn-warning"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
          <a href="index.php" class="btn btn-default"><i class="fas fa-home"></i> Halaman Utama</a>
        </div>
      </div>
    </div>
  </section>

  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>dist/js/adminlte.min.js"></script>
</body>

</html>