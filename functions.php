<?php

$conn = mysqli_connect("localhost", "root", "", "data_murid");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    global $conn;
    
    // Validasi NIS (harus unik dan numerik)
    $nis = mysqli_real_escape_string($conn, $data["NIS"]);
    if (!is_numeric($nis)) {
        echo "<script>alert('NIS harus berupa angka!');</script>";
        return false;
    }
    
    // Cek apakah NIS sudah ada
    $check_nis = mysqli_query($conn, "SELECT NIS FROM siswa_tes WHERE NIS = '$nis'");
    if(mysqli_num_rows($check_nis) > 0) {
        echo "<script>alert('NIS sudah terdaftar!');</script>";
        return false;
    }
    
    // Escape string untuk mencegah SQL injection
    $nama = mysqli_real_escape_string($conn, $data["NAMA"]);
    $kelas = mysqli_real_escape_string($conn, $data["KELAS"]);
    $jurusan = mysqli_real_escape_string($conn, $data["JURUSAN"]);
    $jenis_kelamin = mysqli_real_escape_string($conn, $data["JENIS_KELAMIN"]);
    $alamat = mysqli_real_escape_string($conn, $data["alamat"]);
    
    // Upload foto
    $foto = upload();
    if(!$foto) {
        return false;
    }
    
    try {
        $query = "INSERT INTO siswa_tes 
                (NIS, NAMA, KELAS, JURUSAN, JENIS_KELAMIN, alamat, foto)
                VALUES 
                ('$nis', '$nama', '$kelas', '$jurusan', '$jenis_kelamin', '$alamat', '$foto')";
        
        mysqli_query($conn, $query) or throw new Exception(mysqli_error($conn));
        
        return mysqli_affected_rows($conn);
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        return false;
    }
}

function upload() {
    $namaFiles = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // Cek apakah ada file yang diupload
    if($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // Cek ekstensi file
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = strtolower(pathinfo($namaFiles, PATHINFO_EXTENSION));
    
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>alert('Yang anda upload bukan gambar!');</script>";
        return false;
    }

    // Ubah ukuran maksimal file menjadi 10MB (10 * 1024 * 1024 bytes)
    if($ukuranFile > 10485760) {
        echo "<script>alert('Ukuran gambar terlalu besar! Maksimal 10MB');</script>";
        return false;
    }

    // Generate nama file baru
    $timestamp = time();
    $namaFileTanpaEkstensi = pathinfo($namaFiles, PATHINFO_FILENAME);
    $namaFilesBaru = $namaFileTanpaEkstensi . '_' . $timestamp . '.' . $ekstensiGambar;
    
    // Pastikan direktori upload ada
    $uploadDir = 'img/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Upload file
    if (!move_uploaded_file($tmpName, $uploadDir . $namaFilesBaru)) {
        echo "<script>alert('Gagal mengupload gambar!');</script>";
        return false;
    }

    return $namaFilesBaru;
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa_tes WHERE NIS = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $nis = htmlspecialchars($data["NIS"]);
    $nama = htmlspecialchars($data["NAMA"]);
    $kelas = htmlspecialchars($data["KELAS"]);
    $jurusan = htmlspecialchars($data["JURUSAN"]);
    $jenis_kelamin = htmlspecialchars($data["JENIS_KELAMIN"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $fotoLama = htmlspecialchars($data["fotoLama"]);

    if($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload();
    }

    $query = "UPDATE siswa_tes SET
                NAMA = '$nama',
                KELAS = '$kelas',
                JURUSAN = '$jurusan',
                JENIS_KELAMIN = '$jenis_kelamin',
                alamat = '$alamat',
                foto = '$foto'
                WHERE NIS = '$nis'
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>