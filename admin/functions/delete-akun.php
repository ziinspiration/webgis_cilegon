<?php

require 'functions.php';
$id = $_GET['id'];

$count = countAkun();

if ($count == 1) {
    echo "<script>
            alert('Tidak dapat menghapus data. Minimal harus ada 1 data tersisa.');
            document.location.href = '../admin-setting.php';
        </script>";
} else {
    if (deleteAkun($id) > 0) {
        echo "<script>
                alert('Data Berhasil dihapus');
                document.location.href = '../admin-setting.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus');
                document.location.href = '../admin-setting.php';
            </script>";
    }
}