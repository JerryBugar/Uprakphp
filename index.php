<?php
require 'functions.php';

// Ubah query untuk mengurutkan berdasarkan waktu pembuatan
$ieu = query("SELECT * FROM siswa_tes ORDER BY created_at ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body class="py-5">
    <div class="container">
        <h1 class="text-center text-white mb-4">Data Siswa</h1>

        <div class="table-container p-4 mb-4">
            <div class="mb-4">
                <a href="tambahdata.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Data Siswa
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-striped table-bordered align-middle custom-table">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-center">
                                <i class="bi bi-card-checklist"></i> NO
                            </th>
                            <th scope="col" class="text-center">
                                <i class="bi bi-gear"></i> Aksi
                            </th>
                            <th scope="col">
                                <i class="bi bi-person-badge"></i> NIS
                            </th>
                            <th scope="col">
                                <i class="bi bi-person"></i> Nama
                            </th>
                            <th scope="col">
                                <i class="bi bi-mortarboard"></i> Kelas
                            </th>
                            <th scope="col">
                                <i class="bi bi-book"></i> Jurusan
                            </th>
                            <th scope="col">
                                <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin
                            </th>
                            <th scope="col">
                                <i class="bi bi-geo-alt"></i> Alamat
                            </th>
                            <th scope="col" class="text-center">
                                <i class="bi bi-image"></i> Foto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($ieu as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $i; ?></td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="ubah.php?nis=<?= $row["NIS"]; ?>" 
                                       class="btn btn-warning btn-sm" 
                                       data-bs-toggle="tooltip" 
                                       title="Edit Data">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="hapus.php?nis=<?= $row["NIS"]; ?>" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin ingin menghapus data ini?');"
                                       data-bs-toggle="tooltip" 
                                       title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    <a href="#" 
                                       class="btn btn-info btn-sm view-details"
                                       data-bs-toggle="tooltip" 
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                            <td><span class="badge bg-primary"><?= $row["NIS"]; ?></span></td>
                            <td>
                                <i class="bi bi-person-circle text-primary me-2"></i>
                                <?= $row["NAMA"]; ?>
                            </td>
                            <td>
                                <span class="badge bg-success">
                                    <i class="bi bi-mortarboard-fill me-1"></i>
                                    <?= $row["KELAS"]; ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <i class="bi bi-book-fill me-1"></i>
                                    <?= $row["JURUSAN"]; ?>
                                </span>
                            </td>
                            <td>
                                <?php if($row["JENIS_KELAMIN"] == "L"): ?>
                                    <i class="bi bi-gender-male text-primary"></i> Laki-laki
                                <?php else: ?>
                                    <i class="bi bi-gender-female text-danger"></i> Perempuan
                                <?php endif; ?>
                            </td>
                            <td>
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                <?= $row["alamat"]; ?>
                            </td>
                            <td class="text-center">
                                <div class="position-relative d-inline-block">
                                    <img src="img/<?= $row["foto"]; ?>" 
                                         class="img-thumbnail" 
                                         alt="Foto <?= $row["NAMA"]; ?>"
                                         data-bs-toggle="tooltip" 
                                         title="Klik untuk memperbesar">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <i class="bi bi-camera"></i>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan kode modal di bawah div.container sebelum script -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Siswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="" alt="Foto Siswa" class="detail-foto img-fluid rounded mb-3" style="max-height: 200px;">
                    </div>
                    <div class="detail-info">
                        <table class="table table-borderless">
                            <tr>
                                <td width="130"><strong>NIS</strong></td>
                                <td width="20">:</td>
                                <td class="detail-nis"></td>
                            </tr>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td class="detail-nama"></td>
                            </tr>
                            <tr>
                                <td><strong>Kelas</strong></td>
                                <td>:</td>
                                <td class="detail-kelas"></td>
                            </tr>
                            <tr>
                                <td><strong>Jurusan</strong></td>
                                <td>:</td>
                                <td class="detail-jurusan"></td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin</strong></td>
                                <td>:</td>
                                <td class="detail-jk"></td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td class="detail-alamat"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    // Inisialisasi tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Efek hover untuk gambar
    document.querySelectorAll('.img-thumbnail').forEach(img => {
        img.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.5)';
            this.style.transition = 'transform 0.3s ease';
            this.style.zIndex = '1000';
        });
        
        img.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
            this.style.zIndex = '1';
        });
    });

    // Handle tombol lihat detail
    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const row = this.closest('tr');
            
            // Ambil data dari row tabel
            const nis = row.querySelector('td:nth-child(3)').textContent;
            const nama = row.querySelector('td:nth-child(4)').textContent.trim();
            const kelas = row.querySelector('td:nth-child(5)').textContent.trim();
            const jurusan = row.querySelector('td:nth-child(6)').textContent.trim();
            const jk = row.querySelector('td:nth-child(7)').textContent.trim();
            const alamat = row.querySelector('td:nth-child(8)').textContent.trim();
            const foto = row.querySelector('img').src;

            // Set data ke modal
            document.querySelector('.detail-foto').src = foto;
            document.querySelector('.detail-nis').textContent = nis;
            document.querySelector('.detail-nama').textContent = nama;
            document.querySelector('.detail-kelas').textContent = kelas;
            document.querySelector('.detail-jurusan').textContent = jurusan;
            document.querySelector('.detail-jk').textContent = jk;
            document.querySelector('.detail-alamat').textContent = alamat;

            // Tampilkan modal
            const modal = new bootstrap.Modal(document.getElementById('detailModal'));
            modal.show();
        });
    });
    </script>
</body>
</html>