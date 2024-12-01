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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="py-5">
    <div class="container">
        <div class="mb-4">
            <a href="index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="text-center mb-4">Ubah Data Siswa</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="NIS" value="<?= $sws["NIS"]; ?>">
                            <input type="hidden" name="fotoLama" value="<?= $sws["foto"]; ?>">
                            
                            <div class="mb-3">
                                <label for="NAMA" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="NAMA" id="NAMA" 
                                       value="<?= $sws["NAMA"]; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="KELAS" class="form-label">Kelas</label>
                                <input type="text" class="form-control" name="KELAS" id="KELAS" 
                                       value="<?= $sws["KELAS"]; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="JURUSAN" class="form-label">Jurusan</label>
                                <input type="text" class="form-control" name="JURUSAN" id="JURUSAN" 
                                       value="<?= $sws["JURUSAN"]; ?>" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="JENIS_KELAMIN" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="JENIS_KELAMIN" id="JENIS_KELAMIN" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" <?= ($sws["JENIS_KELAMIN"] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?= ($sws["JENIS_KELAMIN"] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat" id="alamat" rows="3" required><?= $sws["alamat"]; ?></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="foto" class="form-label">Foto Siswa</label>
                                <div class="file-upload">
                                    <label class="file-upload-label">
                                        <i class="bi bi-cloud-upload"></i>
                                        <span>Pilih foto atau seret ke sini</span>
                                        <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                    </label>
                                    <div class="file-name">Tidak ada file yang dipilih</div>
                                </div>
                                <?php if($sws["foto"]): ?>
                                    <div class="image-preview mt-3">
                                        <img src="img/<?= $sws["foto"]; ?>" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary px-5">
                                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Tidak ada file yang dipilih';
        document.querySelector('.file-name').textContent = fileName;
        
        // Preview image
        const preview = document.querySelector('.image-preview');
        const previewImg = preview.querySelector('img');
        
        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
    </script>
</body>
</html>