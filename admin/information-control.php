<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

// if (isset($_POST['send'])) {
//     $nama_data = clean_input($_POST['nama_data']);
//     $informasi = clean_input($_POST['informasi']);
//     $jenis_informasi = clean_input($_POST['jenis_informasi']);

//     $query = "INSERT INTO informasi_bappeda (nama_data, informasi, jenis_informasi) VALUES ('$nama_data', '$informasi', '$jenis_informasi')";

//     if (mysqli_query($conn, $query)) {
//         echo "<script>
//         alert('Data berhasil ditambahkan.');
//         window.location = 'information-control';
//       </script>";
//     } else {
//         echo "Terjadi kesalahan: " . mysqli_error($conn);
//     }
// }

// mysqli_close($conn);


$nama_halaman = 'Information control';
$linkcss = 'information-control.css';
require 'views/information-control.view.php';
