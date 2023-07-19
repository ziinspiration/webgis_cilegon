<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

if (isset($_POST['send'])) {
    // Mendapatkan data dari form
    $nama_adm = htmlspecialchars($_POST['nama_adm']);
    $checkbox_id = htmlspecialchars($_POST['checkbox_id']);

    // Cek apakah file telah diunggah
    if (isset($_FILES['file_json']) && $_FILES['file_json']['error'] === UPLOAD_ERR_OK) {
        // Mendapatkan informasi file
        $file_name = $_FILES['file_json']['name'];
        $file_tmp = $_FILES['file_json']['tmp_name'];
        $file_type = $_FILES['file_json']['type'];

        // Pindahkan file ke direktori tujuan
        $upload_dir = '../assets/geojson/administrasi/';
        $upload_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // Memasukkan data ke tabel administrasi
            $query = "INSERT INTO administrasi (nama_adm, file_json, checkbox_id) VALUES (?, ?, ?)";

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'sss', $nama_adm, $file_name, $checkbox_id);

            // Menjalankan query
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                echo "<script>alert('Data berhasil ditambahkan ke tabel administrasi');</script>";
                echo "<script>window.location.href = 'daftar-administrasi.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "<script>alert('Gagal mengunggah file GeoJSON');</script>";
        }
    } else {
        echo "<script>alert('Mohon pilih file GeoJSON yang valid');</script>";
    }
}

$nama_halaman = 'Tambah administrasi';
$linkcss = 'tambah-administrasi.css';
require 'views/tambah-administrasi.view.php';
