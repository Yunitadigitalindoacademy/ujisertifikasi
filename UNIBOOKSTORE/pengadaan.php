<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNIBOOKSTORE - PENGADAAN</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f5f5f5; }
    header { background-color: #004080; padding: 20px; color: white; text-align: center; }
    nav { background-color: #003366; padding: 10px; text-align: center; }
    nav a { color: white; text-decoration: none; margin: 0 15px; font-weight: bold; }
    nav a:hover { text-decoration: underline; }
    main { padding: 20px; }
    h1, h2 { color: #004080; }
    table { width: 100%; border-collapse: collapse; background: white; }
    th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
    th { background-color: #0073e6; color: white; }
    .container { max-width: 900px; margin: 0 auto; }
  </style>
</head>
<body>
  <header>
    <h1>UNIBOOKSTORE</h1>
    <p>Halaman Pengadaan - Buku Stok Rendah</p>
  </header>
  <nav>
    <a href="index.php">HOME</a>
    <a href="admin.php">ADMIN</a>
    <a href="pengadaan.php">PENGADAAN</a>
  </nav>
  <main class="container">
    <h2>Daftar Buku yang Perlu Segera Dibeli</h2>
    <p>Berikut ini adalah buku-buku yang memiliki stok paling sedikit dan perlu segera dilakukan pengadaan ulang:</p>
    <table>
      <tr>
        <th>Nama Buku</th>
        <th>Penerbit</th>
        <th>Sisa Stok</th>
      </tr>
      <?php
      $query = "SELECT buku.nama_buku, penerbit.nama AS nama_penerbit, buku.stok
                FROM buku
                JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
                ORDER BY buku.stok ASC
                LIMIT 5";
      $result = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['nama_buku']}</td>
                  <td>{$row['nama_penerbit']}</td>
                  <td>{$row['stok']}</td>
                </tr>";
      }
      ?>
    </table>
  </main>
</body>
</html>