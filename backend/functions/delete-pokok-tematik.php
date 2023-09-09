<?php

require 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (deletePokokTematik($id)) {
        echo "<script>
                alert('Data Berhasil dihapus');
                window.location.href = '../update-data-pokok-tematik';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus');
                window.location.href = '../update-data-pokok-tematik';
            </script>";
    }
} else {
    echo "<script>
            alert('ID tidak valid');
            window.location.href = '../update-data-pokok-tematik';
        </script>";
}
