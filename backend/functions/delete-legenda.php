<?php

require 'functions.php';
$id = $_GET['id'];

if (deleteLegenda($id)) {
    echo "<script>
                alert('Data Berhasil dihapus');
                document.location.href = '../data-legenda';
            </script>";
} else {
    echo "<script>
                alert('Data Gagal dihapus');
                document.location.href = '../data-legenda';
            </script>";
}
