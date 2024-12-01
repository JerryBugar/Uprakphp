<?php
require 'functions.php';

$id = $_GET["nis"];

if(hapus($id) > 0){
    echo "
    <script>
        alert('Data berhasil dihapus!');
        document.location.href = 'index.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data gagal dihapus! ID: $id');
        document.location.href = 'index.php';
    </script>
    ";
}
?>