<?php 
include 'config.php'; 

// Fungsi Hapus Buku
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id'");
  header('Location: admin.php');
  exit();
}

// Fungsi Tambah Buku
if (isset($_POST['tambah'])) {
  $id = $_POST['id_buku'];
  $kategori = $_POST['kategori'];
  $nama = $_POST['nama_buku'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $id_penerbit = $_POST['id_penerbit'];

  mysqli_query($koneksi, "INSERT INTO buku VALUES ('$id', '$kategori', '$nama', '$harga', '$stok', '$id_penerbit')");
  header('Location: admin.php');
  exit();
}

// Fungsi Edit Buku
if (isset($_POST['edit'])) {
  $id = $_POST['id_buku'];
  $kategori = $_POST['kategori'];
  $nama = $_POST['nama_buku'];
  $harga = $_POST['harga'];
  $stok = $_POST['stok'];
  $id_penerbit = $_POST['id_penerbit'];

  mysqli_query($koneksi, "UPDATE buku SET kategori='$kategori', nama_buku='$nama', harga='$harga', stok='$stok', id_penerbit='$id_penerbit' WHERE id_buku='$id'");
  header('Location: admin.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UNIBOOKSTORE - Admin</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f9f9f9; }
    header, nav { background-color: #2c3e50; color: white; padding: 15px; text-align: center; }
    nav a { margin: 0 10px; color: white; text-decoration: none; font-weight: bold; }
    main { padding: 20px; margin: auto; background: white; max-width: 100%; box-sizing: border-box; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; overflow-x: auto; display: block; }
    th, td { border: 1px solid #ddd; padding: 8px; text-align: left; white-space: nowrap; }
    th { background-color: #2980b9; color: white; }
    .btn { padding: 6px 12px; border-radius: 4px; color: white; text-decoration: none; display: inline-block; }
    .btn-tambah { background-color: #3498db; }
    .btn-edit { background-color: #2ecc71; }
    .btn-hapus { background-color: #e74c3c; }
    .modal { background: #ecf0f1; padding: 20px; border-radius: 6px; width: 90%; max-width: 500px; }
    label { display: block; margin-top: 10px; }
    input, select { width: 100%; padding: 8px; margin-top: 5px; }
    button { margin-top: 15px; padding: 10px 16px; background-color: #2980b9; color: white; border: none; border-radius: 4px; }
    .overlay {
      position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
      background: rgba(0, 0, 0, 0.5); display: flex; align-items: center; justify-content: center;
      z-index: 999;
    }
    @media (max-width: 600px) {
      .modal { width: 95%; }
      th, td { font-size: 12px; padding: 6px; }
      .btn { font-size: 12px; padding: 5px 10px; }
    }
  </style>
</head>
<body>
<header>
  <h1>UNIBOOKSTORE</h1>
  <p>Halaman Admin - Kelola Buku</p>
</header>
<nav>
  <a href="index.php">Home</a>
  <a href="admin.php">Admin</a>
  <a href="pengadaan.php">Pengadaan</a>
</nav>
<main>
  <a href="?tambah=true" class="btn btn-tambah">+ Tambah Buku</a>

  <?php if (isset($_GET['tambah'])): ?>
  <div class="overlay">
    <div class="modal">
      <h2>Tambah Buku</h2>
      <form method="POST">
        <label>ID Buku:</label>
        <input type="text" name="id_buku" required>
        <label>Nama Buku:</label>
        <input type="text" name="nama_buku" required>
        <label>Kategori:</label>
        <input type="text" name="kategori" required>
        <label>Harga:</label>
        <input type="number" name="harga" required>
        <label>Stok:</label>
        <input type="number" name="stok" required>
        <label>Penerbit:</label>
        <select name="id_penerbit">
          <?php $p = mysqli_query($koneksi, "SELECT * FROM penerbit");
          while ($row = mysqli_fetch_assoc($p)) {
            echo "<option value='{$row['id_penerbit']}'>{$row['nama']}</option>";
          } ?>
        </select>
        <button type="submit" name="tambah">Simpan</button>
        <a href="admin.php">Batal</a>
      </form>
    </div>
  </div>
  <?php endif; ?>

  <?php if (isset($_GET['edit'])):
    $id_edit = $_GET['edit'];
    $data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id_edit'");
    $b = mysqli_fetch_assoc($data);
  ?>
  <div class="overlay">
    <div class="modal">
      <h2>Edit Buku</h2>
      <form method="POST">
        <label>ID Buku:</label>
        <input type="text" name="id_buku" value="<?= $b['id_buku'] ?>" readonly>
        <label>Nama Buku:</label>
        <input type="text" name="nama_buku" value="<?= $b['nama_buku'] ?>" required>
        <label>Kategori:</label>
        <input type="text" name="kategori" value="<?= $b['kategori'] ?>" required>
        <label>Harga:</label>
        <input type="number" name="harga" value="<?= $b['harga'] ?>" required>
        <label>Stok:</label>
        <input type="number" name="stok" value="<?= $b['stok'] ?>" required>
        <label>Penerbit:</label>
        <select name="id_penerbit">
          <?php $p = mysqli_query($koneksi, "SELECT * FROM penerbit");
          while ($row = mysqli_fetch_assoc($p)) {
            $selected = ($row['id_penerbit'] == $b['id_penerbit']) ? 'selected' : '';
            echo "<option value='{$row['id_penerbit']}' $selected>{$row['nama']}</option>";
          } ?>
        </select>
        <button type="submit" name="edit">Update</button>
        <a href="admin.php">Batal</a>
      </form>
    </div>
  </div>
  <?php endif; ?>

  <h2>Daftar Buku</h2>
  <table>
    <tr>
      <th>ID</th><th>Nama Buku</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Penerbit</th><th>Aksi</th>
    </tr>
    <?php
    $q = mysqli_query($koneksi, "SELECT buku.*, penerbit.nama AS nama_penerbit FROM buku JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit");
    while ($r = mysqli_fetch_assoc($q)) {
      echo "<tr>
        <td>{$r['id_buku']}</td>
        <td>{$r['nama_buku']}</td>
        <td>{$r['kategori']}</td>
        <td>Rp " . number_format($r['harga'], 0, ',', '.') . "</td>
        <td>{$r['stok']}</td>
        <td>{$r['nama_penerbit']}</td>
        <td>
          <a class='btn btn-edit' href='?edit={$r['id_buku']}'>Edit</a>
          <a class='btn btn-hapus' href='?hapus={$r['id_buku']}' onclick=\"return confirm('Hapus buku ini?')\">Hapus</a>
        </td>
      </tr>";
    }
    ?>
  </table>
</main>
</body>
</html>