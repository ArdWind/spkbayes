<?php
// ...\spkbayes\public\admin.php

// PENTING: Aktifkan Output Buffering di awal file
ob_start();

// Mulai sesi
session_start();

// Base URL AdminLTE (sesuai yang Anda gunakan di header/footer)
$BASE_URL_ADMINLTE = "./adminlte/";

// --- 1. DEFINISI ROUTES ADMIN ---
// Gunakan format: ['halaman' => 'path/ke/file.php']
$admin_routes = [
    // Halaman Autentikasi
    'login' => 'pages/login.php',
    'daftar' => 'pages/register.php',
    'logout' => 'logout.php',

    // Halaman Dashboard
    'dashboard' => 'pages/dashboardadmin/dashboard_admin.php',

    // Halaman SPK Bayes (dulu ada di index.php)
    'data_latih' => 'pages/dashboardadmin/data_latih.php',
    'data_probabilitas' => 'pages/dashboardadmin/data_probabilitas.php',

    // Rute yang memakai Controller MVC (SPK Core)
    'form_input' => 'mvc/form_input.php',     // Router ke MVC index.php
    'list_results' => 'mvc/list_results.php', // Router ke MVC index.php
];

$page = $_GET['page'] ?? 'dashboard';

// --- 2. CEK STATUS LOGIN ---
$is_logged_in = $_SESSION['user_logged_in'] ?? false;

// Fungsi redirect aman
function redirect_and_exit($location)
{
    // Karena ob_start() sudah aktif, ini akan aman
    header("Location: " . $location);
    ob_end_flush(); // Hentikan buffering dan kirim output
    exit();
}

// Jika belum login, hanya boleh akses login/daftar
if (!$is_logged_in && !in_array($page, ['login', 'daftar'])) {
    // Redirect ke login jika mencoba akses halaman lain
    redirect_and_exit("admin.php?page=login");
}

// Jika sudah login, dan user mencoba mengakses login/daftar, arahkan ke dashboard
if ($is_logged_in && in_array($page, ['login', 'daftar'])) {
    redirect_and_exit("admin.php?page=dashboard");
}

// --- 3. EXECUTION ---
if (isset($admin_routes[$page])) {
    $content_file = $admin_routes[$page];

    // Periksa apakah ini adalah salah satu rute SPK Core (yang menggunakan Controller/MVC)
    if ($page === 'form_input' || $page === 'list_results') {

        $SPK_CORE_PAGE_TO_LOAD = $page;
        $page_title = ($page == 'form_input') ? 'Input Data Evaluasi' : 'Riwayat Hasil Evaluasi';

        // Tentukan Controller & Method berdasarkan apakah ini GET atau POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'form_input') {
            // Jika POST, panggil method store()
            $core_method = 'store';
        } else {
            // Jika GET, panggil method create() atau index()
            $core_method = ($page === 'form_input') ? 'create' : 'index';
        }

        // Load Header AdminLTE
        require_once 'layouts/header.php';

        // Panggil SPK Core Engine (MVC)
        require __DIR__ . '/../vendor/autoload.php';

        $routes = include __DIR__ . '/../config/routes.php';

        // Cari Class Controller yang sesuai
        if (isset($routes['form_input'])) {
            // Ambil Class dari rute 'form_input' karena keduanya (form_input & list_results) 
            // ditangani oleh EvaluationController
            [$class, $default_method] = $routes['form_input'];
            $controller = new $class();

            // Panggil method yang sudah ditentukan (store atau create/index)
            $controller->$core_method();
        } else {
            require 'pages/404.php';
        }

        // Load Footer AdminLTE
        require_once 'layouts/footer.php';
    } else {
        // --- LOGIKA HALAMAN NON-MVC (Dashboard, Data Latih, Matriks, Login, Daftar) ---

        // Halaman ber-layout (semua kecuali login/daftar)
        if ($page !== 'login' && $page !== 'daftar') {
            require_once 'layouts/header.php';
        }
        require $content_file;
        if ($page !== 'login' && $page !== 'daftar') {
            require_once 'layouts/footer.php';
        }
    }
} else {
    // 404
    http_response_code(404);
    require 'pages/404.php';
}

// Flush Output Buffer di akhir
ob_end_flush();
