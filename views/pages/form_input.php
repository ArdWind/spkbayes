<!DOCTYPE html>
<html>

<head>
  <title>Evaluasi Ekskul Baru</title>
</head>

<body>

  <h1>📝 Entri Data Evaluasi Per Periode</h1>

  <form method="POST" action="index.php?page=evaluation_store">

    <h2>Periode Evaluasi</h2>
    <label>Semester:</label>
    <input type="text" name="semester" value="2025-2" required />

    <table border="1" cellpadding="8" cellspacing="0">
      <thead>
        <tr>
          <th>Nama Ekskul</th>
          <th>X1 Jumlah Anggota (%)</th>
          <th>X2 Absensi (%)</th>
          <th>X3 Prestasi</th>
          <th>X4 Kepuasan</th>
          <th>X5 Pembina</th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($ekskulOptions as $ek): ?>
          <tr>
            <td>
              <?= $ek ?>
              <input type="hidden" name="ekskul_data[<?= $ek ?>][name]" value="<?= $ek ?>">
            </td>

            <td><input type="number" name="ekskul_data[<?= $ek ?>][x1_anggota_count]" required></td>
            <td><input type="number" step="0.1" name="ekskul_data[<?= $ek ?>][x2_absensi_percent]" required></td>

            <td>
              <select name="ekskul_data[<?= $ek ?>][x3_prestasi_status]">
                <option value="TAP">Tidak Ada Piala</option>
                <option value="AP">Ada Piala</option>
              </select>
            </td>

            <td>
              <select name="ekskul_data[<?= $ek ?>][x4_kepuasan_modus]">
                <option value="P">Puas</option>
                <option value="SP">Sangat Puas</option>
                <option value="TP">Tidak Puas</option>
              </select>
            </td>

            <td>
              <select name="ekskul_data[<?= $ek ?>][x5_pembina_type]">
                <option value="GS">Guru Sekolah</option>
                <option value="BS">Bersertifikat</option>
                <option value="A">Alumni</option>
              </select>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
    </table>

    <button type="submit">Prediksi</button>
  </form>

</body>

</html>