<?php

require 'functions.php';
$id = $_GET['id'];

$count = countAdministrasi();

if ($count == 1) {
    echo "<script>
            alert('Tidak dapat menghapus data. Minimal harus ada 1 data tersisa.');
            document.location.href = '../ubah-administrasi.php';
        </script>";
} else {
    if (deleteAdministrasi($id) > 0) {
        echo "<script>
                alert('Data Berhasil dihapus');
                document.location.href = '../ubah-administrasi.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus');
                document.location.href = '../ubah-administrasi.php';
            </script>";
    }
}
