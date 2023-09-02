<?php
require 'functions.php';

// Periksa apakah id_atribut dan id_pokok ada dalam URL
if (isset($_GET['id_atribut']) && isset($_GET['id_pokok'])) {
    $id_atribut = $_GET['id_atribut'];
    $id_pokok = $_GET['id_pokok'];

    if (deleteAtributAdministrasi($id_atribut)) {
        echo "<script>
                alert('Data Berhasil dihapus');
                window.location.href = '../ubah-atribut-administrasi?id=$id_pokok';
            </script>";
    } else {
        echo "<script>
                alert('Data Gagal dihapus');
                window.location.href = '../ubah-atribut-administrasi?id=$id_pokok';
            </script>";
    }
} else {
    echo "<script>
            alert('ID tidak valid');
            window.location.href = '../update-data-atribut-administrasi';
        </script>";
}
