<?php

use App\Controllers\EvaluationController;

return [

    // Form Input
    'form_input' => [EvaluationController::class, 'create'],

    // Proses Prediksi
    'evaluation_store' => [EvaluationController::class, 'store'],

    // Tampilkan Riwayat
    'list_results' => [EvaluationController::class, 'index'],

];
