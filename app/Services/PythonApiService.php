<?php

namespace App\Services;

class PythonApiService
{
  private $apiUrl = "http://127.0.0.1:5000/api/predict";

  public function predict(array $payload)
  {
    $jsonData = json_encode($payload);

    $ch = curl_init($this->apiUrl);

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      "Content-Type: application/json",
      "Content-Length: " . strlen($jsonData)
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
      return [
        'error' => true,
        'message' => 'Gagal menghubungi API Python: ' . curl_error($ch)
      ];
    }

    curl_close($ch);
    return json_decode($response, true);
  }
}
