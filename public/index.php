<?php
// ...\spkbayes\public\index.php (REVISI)

// Mulai sesi (diperlukan untuk login/logout)
session_start();

$page = $_GET['page'] ?? 'home';

// Jika halaman yang diminta adalah SPK Core (form_input, list_results) 
// atau halaman Admin (dashboard, login, dll), redirect ke admin.php.
if (in_array($page, ['form_input', 'list_results', 'dashboard', 'login', 'daftar'])) {
  header("Location: admin.php?page={$page}");
  exit;
}

// Jika halaman yang diminta adalah HOME
if ($page === 'home') {
  require 'home.php';
}
// Jika halaman yang diminta adalah LOGOUT
elseif ($page === 'logout') {
  require 'logout.php';
} else {
  // 404 untuk halaman non-admin lainnya
  require 'pages/404.php';
}
