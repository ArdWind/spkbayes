<?php
//...\spkbayes\public\pages\login.php
// CATATAN: Variabel $BASE_URL_ADMINLTE sudah tersedia dari admin.php

// --- Logika Penanganan POST Login ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

  // --- SIMULASI PROSES AUTENTIKASI ---
  // Ganti bagian ini dengan koneksi database dan verifikasi password

  $user_role = null;
  $user_nama = 'Tamu';

  if ($email === 'admin@mail.com' && $password === 'admin') {
    $user_role = 'admin';
    $user_nama = 'Administrator SPK';
  } elseif ($email === 'guru@mail.com' && $password === 'guru') {
    $user_role = 'guru';
    $user_nama = 'Ibu Guru Ani';
  } elseif ($email === 'siswa@mail.com' && $password === 'siswa') {
    $user_role = 'siswa';
    $user_nama = 'Siswa Budi';
  }

  if ($user_role) {
    // Login Berhasil: Set Sesi
    $_SESSION['user_logged_in'] = true;
    $_SESSION['user_role'] = $user_role;
    $_SESSION['user_nama'] = $user_nama;

    // Redirect ke Dashboard
    header("Location: admin.php?page=dashboard");
    exit();
  } else {
    // Login Gagal
    $error_message = "Email atau Password salah!";
  }
}
// --- Akhir Logika Penanganan POST Login ---
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPK Bayes | Log in</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= $BASE_URL_ADMINLTE ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

  <div class="login-box">
    <div class="login-logo">
      <a href="index.php"><b>SPK</b> Bayes</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masukkan Email dan Password Anda</p>

        <?php if (isset($error_message)): ?>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?= $error_message ?>
          </div>
        <?php endif; ?>

        <form action="admin.php?page=login" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
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
          <div class="row">
            <div class="col-8">
              <p class="mt-2 text-muted">Demo Akun (email/password):</p>
              <ul>
                <li>admin/admin</li>
                <li>guru/guru</li>
                <li>siswa/siswa</li>
              </ul>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>

        <p class="mb-1">
          <a href="index.php">Kembali ke Halaman Utama</a>
        </p>
      </div>
    </div>
  </div>
  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= $BASE_URL_ADMINLTE ?>dist/js/adminlte.min.js"></script>
</body>

</html>
