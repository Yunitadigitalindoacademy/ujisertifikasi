<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNIBOOKSTORE - HOME</title>
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
    .search-box { margin-bottom: 20px; }
  </style>
</head>
<body>
  <header>
    <h1>UNIBOOKSTORE</h1>
    <p>Halaman Utama - Daftar Buku</p>
  </header>
  <nav>
    <a href="index.php">HOME</a>
    <a href="admin.php">ADMIN</a>
    <a href="pengadaan.php">PENGADAAN</a>
  </nav>
  <main class="container">
    <h2>Daftar Buku</h2>
    <form method="GET" class="search-box">
      <label>Cari Nama Buku:</label>
      <input type="text" name="cari" placeholder="Masukkan judul...">
      <button type="submit">Cari</button>
    </form>

    <table>
      <tr>
        <th>ID Buku</th>
        <th>Kategori</th>
        <th>Nama Buku</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Penerbit</th>
      </tr>
      <?php
      $where = "";
      if (isset($_GET['cari']) && $_GET['cari'] !== '') {
        $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
        $where = "WHERE buku.nama_buku LIKE '%$cari%'";
      }
      $query = "SELECT buku.*, penerbit.nama AS nama_penerbit
                FROM buku
                JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
                $where";
      $result = mysqli_query($koneksi, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['id_buku']}</td>
                <td>{$row['kategori']}</td>
                <td>{$row['nama_buku']}</td>
                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                <td>{$row['stok']}</td>
                <td>{$row['nama_penerbit']}</td>
              </tr>";
      }
      ?>
    </table>
  </main>
</body>
</html>
