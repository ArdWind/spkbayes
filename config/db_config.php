<?php
// ...\spkbayes\config\db_config.php

// Ambil konfigurasi dari file database.php utama
$config = include __DIR__ . '/database.php';

// Pastikan konfigurasi MySQLi tersedia
$DB_HOST = $config['host'];
$DB_USER = $config['username'];
$DB_PASS = $config['password'];
$DB_NAME = $config['database'];
$DB_PORT = $config['port']; // Default 3306

/**
 * Membuat koneksi menggunakan MySQLi.
 * Digunakan oleh halaman pure PHP seperti data_latih dan data_probabilitas.
 * @return \mysqli
 */
function connect_db()
{
  global $DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT;

  // Matikan error reporting sementara untuk koneksi
  $old_error_reporting = error_reporting();
  error_reporting(0);

  $conn = new \mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $DB_PORT);

  // Kembalikan error reporting
  error_reporting($old_error_reporting);

  if ($conn->connect_error) {
    // Hentikan eksekusi dan tampilkan error. return false tidak diperlukan setelah die().
    die("Koneksi Database Gagal: " . $conn->connect_error);
  }

  return $conn;
}
