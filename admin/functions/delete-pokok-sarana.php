<?php

require 'functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (deletePokokSarana($id)) {
        echo "<script>
                alert('Data Berhasil dihapus');
                window.location.href = '../update-data-pokok-sarana';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus');
                window.location.href = '../update-data-pokok-sarana';
            </script>";
    }
} else {
    echo "<script>
            alert('ID tidak valid');
            window.location.href = '../update-data-pokok-sarana';
        </script>";
}
