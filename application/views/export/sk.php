<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= FCPATH . 'dist/css/export.css'; ?>" />
</head>

<body>

  <table>
    <tr>
      <td>
        <img src="<?= FCPATH . 'dist/img/kop.png' ?>">
      </td>
    </tr>
  </table>

  <br>

  <table class="penomoran">
    <tr>
      <td>Nomor</td>
      <td>:</td>
      <td><?= $data['no_sk']; ?></td>
      <td>Batam, <?= tanggal_indo($data['tgl_pengecekan']) ?></td>
    </tr>
    <tr>
      <td>Lampiran</td>
      <td>:</td>
      <td>-</td>
    </tr>
    <tr>
      <td>Perihal</td>
      <td>:</td>
      <td><span class="perihal">Permohonan Izin Penelitian Tugas Akhir</span></td>
    </tr>
  </table>


  <br>
  <br>

  <table>
    <tr>
      <td>Kepada Yth.</td>
    </tr>
    <tr>
      <td><span class="tujuan"><?= $data['unsur_pimpinan'] . ' ' . $data['nm_perusahaan']; ?></span></td>
    </tr>
    <tr>
      <td>Di -</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tempat</td>
    </tr>
  </table>

  <p>
    Dengan Hormat,
    <br>
    Bersama ini kami sampaikan bahwa sehubung dengan rencana penelitian dalam penyelesaian Tugas Akhir/Skripsi Mahasiswa, untuk itu kami mengharapkan kepada Bapak/Ibu kiranya dapat memberikan izin penelitian pada perusahaan yang Bapak/Ibu Pimpin. Adapun Mahasiswa yang dimaksud sebagai berikut:
  </p>


  <table class="detail_mahasiswa">
    <tr>
      <td>Nama Mahasiswa</td>
      <td>:</td>
      <td><?= $data['nm_mahasiswa']; ?></td>
    </tr>
    <tr>
      <td>NPM</td>
      <td>:</td>
      <td><?= $data['nim_mahasiswa']; ?></td>
    </tr>
    <tr>
      <td>Program Studi</td>
      <td>:</td>
      <td><?= $data['nm_prodi']; ?></td>
    </tr>
    <tr>
      <td>Judul</td>
      <td>:</td>
      <td><?= $data['nm_judul']; ?></td>
    </tr>
  </table>

  <p>Demikianlah surat permohonan ini kami buat atas bantuan dan kerjasamanya diucapkan terima kasih.</p>


  <table class="tabel_pimpinan">
    <tr>
      <td>Dekan Fakultas Teknik</td>
    </tr>
    <tr>
      <td>Universitas Ibnu Sina</td>
    </tr>
    <tr>
      <td style="height:100px;"></td>
    </tr>
    <tr>
      <td>Dr. Ir. Larisang, MT.,IPM</td>
    </tr>
    <tr>
      <td>NIP.19650513200501100</td>
    </tr>
  </table>


  <p>Tembusan :<br>- Arsip</p>

</html>