<?php

require 'functions.php';
$id = $_GET['id'];

$count = countPublikasi();

if ($count == 1) {
    echo "<script>
            alert('Tidak dapat menghapus data. Minimal harus ada 1 data tersisa.');
            document.location.href = '../ubah-publikasi';
        </script>";
} else {
    if (deletePublikasi($id) > 0) {
        echo "<script>
                alert('Data Berhasil dihapus');
                document.location.href = '../ubah-publikasi';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus');
                document.location.href = '../ubah-publikasi';
            </script>";
    }
}
