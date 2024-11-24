<?php
require 'functions.php';

$ieu = query("SELECT * FROM siswa_tes ORDER BY NIS ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP Dasar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Data Siswa</h1>

<a href="tambahdata.php" class="btn btn-tambah">Tambah Data Mahasiswa</a>
<br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Foto</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach( $ieu as $row ) : ?>
        <tr>
            <td><?=$i ?></td>
            <td>
                <div class="action-buttons">
                    <a href="ubah.php?nis=<?=$row["NIS"]; ?>" class="btn btn-ubah" onclick="event.stopPropagation();">Ubah</a>
                    <a href="hapus.php?nis=<?=$row["NIS"]; ?>" class="btn btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                </div>
            </td>
            <td><?=$row["NIS"]; ?></td>
            <td><?=$row["NAMA"]; ?></td>
            <td><?=$row["KELAS"]; ?></td>
            <td><?=$row["JURUSAN"]; ?></td>
            <td><?=$row["JENIS_KELAMIN"]; ?></td>
            <td><?=$row["alamat"]; ?></td>
            <td><img src="img/<?=$row["foto"]; ?>" width="50"></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>

</body>
</html>