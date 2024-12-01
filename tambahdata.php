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
    <title>Tambah Data Siswa</title>
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

        <div class="form-container p-4">
            <h2 class="text-center mb-4">Tambah Data Siswa</h2>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="NIS" class="form-label">NIS</label>
                    <input type="text" class="form-control" name="NIS" id="NIS" required>
                </div>

                <div class="mb-3">
                    <label for="NAMA" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="NAMA" id="NAMA" required>
                </div>

                <div class="mb-3">
                    <label for="KELAS" class="form-label">Kelas</label>
                    <input type="text" class="form-control" name="KELAS" id="KELAS" required>
                </div>

                <div class="mb-3">
                    <label for="JURUSAN" class="form-label">Jurusan</label>
                    <input type="text" class="form-control" name="JURUSAN" id="JURUSAN" required>
                </div>

                <div class="mb-3">
                    <label for="JENIS_KELAMIN" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="JENIS_KELAMIN" id="JENIS_KELAMIN" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" required>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Siswa</label>
                    <div class="file-upload">
                        <label class="file-upload-label">
                            <i class="bi bi-cloud-upload"></i>
                            <span>Pilih foto atau seret ke sini</span>
                            <input type="file" class="form-control" name="foto" id="foto" accept="image/*" required>
                        </label>
                        <div class="file-name">Tidak ada file yang dipilih</div>
                    </div>
                    <div class="image-preview mt-3" style="display: none;">
                        <img src="" alt="Preview" class="mb-2">
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data
                </button>
            </form>
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
        } else {
            preview.style.display = 'none';
        }
    });
    </script>
</body>
</html>