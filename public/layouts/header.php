<?php
//...\spkbayes\public\layouts\header.php

// --- Variabel yang dibutuhkan dari admin.php (router) ---
// Pastikan semua variabel sudah diinisialisasi untuk mencegah Notice Error.
if (!isset($BASE_URL_ADMINLTE)) {
  $BASE_URL_ADMINLTE = "./adminlte/";
}
if (!isset($page)) {
  $page = 'dashboard';
}
if (!isset($current_role)) {
  $current_role = 'unknown';
}

// Perbaikan: Pastikan ucwords() dan str_replace() hanya dijalankan jika $page_title belum diatur
if (!isset($page_title)) {
  $page_title = ucwords(str_replace('_', ' ', $page));
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK Bayes | <?= $page_title ?></title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="admin.php?page=dashboard" class="nav-link">Home Dashboard</a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <span class="nav-link text-bold">Role: <?= strtoupper($current_role) ?></span>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <?php
    // --- INI ADALAH TITIK DI MANA SIDEBAR DIMASUKKAN ---
    require 'sidebar.php';
    ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $page_title ?></h1>
            </div>
            <div class="col-sm-6">
            </div>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          ```

          ### 2. 📄 Kode untuk `public/layouts/sidebar.php` (Koreksi Penutup PHP)

          Saya juga memastikan penutup tag PHP sudah benar di file `sidebar.php`.

          ```php