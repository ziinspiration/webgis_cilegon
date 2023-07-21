<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();


if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('Berhasil ditambahkan');
            window.location = 'daftar-akun.php';
          </script>";
    } else {
        echo mysqli_error($conn);
    }
}

$nama_halaman = 'Tambah admin';
$linkcss = 'tambah-admin.css';
require 'views/tambah-admin.view.php';
