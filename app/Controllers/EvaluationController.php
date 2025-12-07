<?php

namespace App\Controllers;

use App\Services\PythonApiService;
use App\Models\EvaluationResult;

class EvaluationController
{
  protected $api;

  public function __construct()
  {
    $this->api = new PythonApiService();
  }

  // FORM INPUT
  public function create()
  {
    $ekskulOptions = ['PASKIBRA', 'PRAMUKA', 'KARATE', 'FUTSAL', 'VOLLEY'];
    include __DIR__ . "/../../views/pages/form_input.php";
  }

  // DISKRITISASI
  private function categorize($anggotaPercent, $absensiPercent)
  {
    $x1 = ($anggotaPercent > 20) ? 'T' : (($anggotaPercent >= 10) ? 'S' : 'R');
    $x2 = ($absensiPercent > 85) ? 'T' : (($absensiPercent >= 70) ? 'S' : 'R');

    return ['x1_anggota' => $x1, 'x2_absensi' => $x2];
  }

  // PROSES & SIMPAN
  public function store()
  {
    $semester = $_POST['semester'];
    $dataEkskul = $_POST['ekskul_data'];
    $resultsCount = 0;

    foreach ($dataEkskul as $ekskul) {

      // Diskritisasi
      $kategori = $this->categorize(
        $ekskul['x1_anggota_count'],
        $ekskul['x2_absensi_percent']
      );

      // Payload ke Python
      $payload = [
        'x1_anggota' => $kategori['x1_anggota'],
        'x2_absensi' => $kategori['x2_absensi'],
        'x3_prestasi' => $ekskul['x3_prestasi_status'],
        'x4_kepuasan' => $ekskul['x4_kepuasan_modus'],
        'x5_pembina' => $ekskul['x5_pembina_type']
      ];

      // Kirim ke API
      $prediction = $this->api->predict($payload);

      if (isset($prediction['error'])) {
        die("API Error: " . $prediction['message']);
      }

      // Simpan DB
      EvaluationResult::create([
        'ekskul_name' => $ekskul['name'],
        'semester' => $semester,
        'input_criteria' => json_encode($payload),
        'predicted_class' => $prediction['predicted_class'],
        'p_sangat_efektif' => $prediction['p_sangat_efektif'],
        'p_efektif' => $prediction['p_efektif'],
        'p_perlu_evaluasi' => $prediction['p_perlu_evaluasi'],
      ]);

      $resultsCount++;
    }

    header("Location: index.php?page=list_results&success={$resultsCount}");
    exit;
  }

  // Tampilkan hasil
  public function index()
  {
    $results = EvaluationResult::all();
    include __DIR__ . "/../../views/pages/list_results.php";
  }
}
