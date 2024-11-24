<?php
require 'functions.php';

$nis = $_GET["nis"];

$sws = query("SELECT * FROM siswa_tes WHERE NIS = '$nis'")[0];

if(isset($_POST["submit"])) {
    if(ubah($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal diubah!');
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
    <title>Ubah Data Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="btn-container">
        <a href="index.php" class="btn btn-kembali">Kembali</a>
    </div>
    <h1>Ubah Data Siswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="NIS" value="<?= $sws["NIS"]; ?>">
        <input type="hidden" name="fotoLama" value="<?= $sws["foto"]; ?>">
        <ul>
            <li>
                <label for="NAMA">Nama : </label>
                <input type="text" name="NAMA" id="NAMA" required 
                value="<?= $sws["NAMA"]; ?>">
            </li>
            <li>
                <label for="KELAS">Kelas : </label>
                <input type="text" name="KELAS" id="KELAS" required 
                value="<?= $sws["KELAS"]; ?>">
            </li>
            <li>
                <label for="JURUSAN">Jurusan : </label>
                <input type="text" name="JURUSAN" id="JURUSAN" required 
                value="<?= $sws["JURUSAN"]; ?>">
            </li>
            <li>
                <label for="JENIS_KELAMIN">Jenis Kelamin : </label>
                <select name="JENIS_KELAMIN" id="JENIS_KELAMIN" required>
                    <option value="L" <?= ($sws["JENIS_KELAMIN"] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?= ($sws["JENIS_KELAMIN"] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </li>
            <li>
                <label for="alamat">Alamat : </label>
                <input type="text" name="alamat" id="alamat" required 
                value="<?= $sws["alamat"]; ?>">
            </li>
            <li>
                <label for="foto">Foto : </label>
                <div class="file-upload-container">
                    <label for="foto" class="custom-file-upload">Pilih Gambar</label>
                    <input type="file" name="foto" id="foto" accept="image/*">
                    <span class="file-name">Tidak ada file yang dipilih</span>
                </div>
                <?php if($sws["foto"]): ?>
                    <div class="image-preview">
                        <img src="img/<?= $sws["foto"]; ?>" width="100">
                        <p>Foto saat ini</p>
                    </div>
                <?php endif; ?>
            </li>
            <li>
                <button type="submit" name="submit" class="btn btn-ubah">Simpan Perubahan</button>
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