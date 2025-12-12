<?php
//...\spkbayes\public\pages\register.php
// CATATAN: Variabel $BASE_URL_ADMINLTE sudah tersedia dari admin.php

// --- Logika Penanganan POST Registrasi ---
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $role = $_POST['role'] ?? 'siswa'; // Default role adalah 'siswa'

  // --- SIMULASI VALIDASI & PENYIMPANAN DATA ---
  if (empty($nama) || empty($email) || empty($password)) {
    $error_message = "Semua field harus diisi.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_message = "Format email tidak valid.";
  } else {
    // Ganti bagian ini dengan koneksi database dan query INSERT

    // SIMULASI: Anggap pendaftaran berhasil
    $success_message = "Pendaftaran berhasil! Silakan login menggunakan akun Anda.";

    // Setelah berhasil, kosongkan variabel POST agar form bersih
    unset($_POST);
  }
}
// --- Akhir Logika Penanganan POST Registrasi ---
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK Bayes | Register</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">

  <div class="register-box">
    <div class="register-logo">
      <a href="index.php"><b>SPK</b> Bayes</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Daftar Akun Baru</p>

        <?php if (isset($error_message) && $error_message): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $error_message ?>
          </div>
        <?php endif; ?>

        <?php if (isset($success_message) && $success_message): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $success_message ?> <a href="admin.php?page=login">Login sekarang</a>
          </div>
        <?php endif; ?>

        <form action="admin.php?page=daftar" method="post">
          <div class="input-group mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required value="<?= $_POST['nama'] ?? '' ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required value="<?= $_POST['email'] ?? '' ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="role_select">Daftar sebagai:</label>
            <select name="role" id="role_select" class="form-control">
              <option value="siswa" selected>Siswa</option>
            </select>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                <label for="agreeTerms">
                  Saya setuju dengan <a href="#">ketentuan</a>
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>
        </form>

        <a href="admin.php?page=login" class="text-center">Saya sudah punya akun</a>
      </div>
    </div>
  </div>
  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>dist/js/adminlte.min.js"></script>
</body>

</html>