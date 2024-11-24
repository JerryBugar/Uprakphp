<?php
require 'functions.php';

if(isset($_POST["submit"])){
    // Tambahkan debugging
    var_dump($_POST);
    var_dump($_FILES);
    
    $result = tambah($_POST);
    if($result > 0){
        echo "
        <script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'index.php';
        </script>
        ";
    }
}
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
    <div class="btn-container">
        <a href="index.php" class="btn btn-kembali">Kembali</a>
    </div>
    <h1>Tambah Data Siswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
    <ul>
        <li>
            <label for="NIS">NIS : </label>
            <input type="text" name="NIS" id="NIS" required>
        </li>
        <li>
            <label for="NAMA">Nama : </label>
            <input type="text" name="NAMA" id="NAMA" required>
        </li>
        <li>
            <label for="KELAS">Kelas : </label>
            <input type="text" name="KELAS" id="KELAS" required>
        </li>
        <li>
            <label for="JURUSAN">Jurusan : </label>
            <input type="text" name="JURUSAN" id="JURUSAN" required>
        </li>
        <li>
            <label for="JENIS_KELAMIN">Jenis Kelamin : </label>
            <select name="JENIS_KELAMIN" id="JENIS_KELAMIN" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </li>
        <li>
            <label for="alamat">Alamat : </label>
            <input type="text" name="alamat" id="alamat" required>
        </li>
        <li>
            <label for="foto">Foto : </label>
            <div class="file-upload-container">
                <label for="foto" class="custom-file-upload">Pilih Gambar</label>
                <input type="file" name="foto" id="foto" accept="image/*" required>
                <span class="file-name">Tidak ada file yang dipilih</span>
            </div>
        </li>
        <li>
            <button type="submit" name="submit" class="btn btn-tambah">Tambah Data</button>
        </li>
    </ul>
    </form>
    <script>
    document.getElementById('foto').addEventListener('change', function() {
        var fileName = this.files[0] ? this.files[0].name : 'Tidak ada file yang dipilih';
        document.querySelector('.file-name').textContent = fileName;
    });
    </script>
</body>
</html>