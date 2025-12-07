<!DOCTYPE html>
<html>

<head>
  <title>Riwayat Prediksi Ekskul</title>
</head>

<body>

  <h1>📚 Riwayat Hasil Prediksi Ekskul</h1>

  <a href="/public/index.php?page=evaluation_create">← Kembali ke Form</a>

  <table border="1" cellpadding="10" cellspacing="0">
    <thead>
      <tr>
        <th>No</th>
        <th>Ekskul</th>
        <th>Semester</th>
        <th>Input</th>
        <th>Prediksi</th>
        <th>P(SE)</th>
        <th>P(E)</th>
        <th>P(PE)</th>
        <th>Waktu</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($results as $i => $res): ?>
        <?php $input = json_decode($res['input_criteria'], true); ?>

        <tr>
          <td><?= $i + 1 ?></td>
          <td><?= $res['ekskul_name'] ?></td>
          <td><?= $res['semester'] ?></td>
          <td>
            X1: <?= $input['x1_anggota'] ?><br>
            X2: <?= $input['x2_absensi'] ?><br>
            X3: <?= $input['x3_prestasi'] ?><br>
            X4: <?= $input['x4_kepuasan'] ?><br>
            X5: <?= $input['x5_pembina'] ?>
          </td>

          <td><?= $res['predicted_class'] ?></td>

          <td><?= $res['p_sangat_efektif'] ?>%</td>
          <td><?= $res['p_efektif'] ?>%</td>
          <td><?= $res['p_perlu_evaluasi'] ?>%</td>

          <td><?= $res['created_at'] ?></td>
        </tr>

      <?php endforeach; ?>

    </tbody>
  </table>

</body>

</html>