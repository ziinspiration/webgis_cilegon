<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getKategori = query("SELECT * FROM kategori_tematik");
$getJenisFile = query("SELECT * FROM jenis_file WHERE nama_jenis <> 'Marker'");

// if (isset($_POST['send'])) {
//     // Mendapatkan data dari form dan membersihkan input menggunakan fungsi clean_input()
//     $nama_tematik = clean_input($_POST['nama_tematik']);
//     $checkbox_id = clean_input($_POST['checkbox_id']);
//     $kategori = clean_input($_POST['kategori']);
//     $id_jenis_file = clean_input($_POST['id_jenis_file']);

//     // Cek apakah file telah diunggah
//     if (isset($_FILES['file_json']) && $_FILES['file_json']['error'] === UPLOAD_ERR_OK) {
//         // Mendapatkan informasi file
//         $file_name = $_FILES['file_json']['name'];
//         $file_tmp = $_FILES['file_json']['tmp_name'];
//         $file_type = $_FILES['file_json']['type'];

//         // Cek apakah nama_tematik sudah ada dalam database
//         $query_check_nama_tematik = "SELECT COUNT(*) FROM tematik WHERE nama_tematik = ?";
//         $stmt_check_nama_tematik = mysqli_prepare($conn, $query_check_nama_tematik);
//         mysqli_stmt_bind_param($stmt_check_nama_tematik, 's', $nama_tematik);
//         mysqli_stmt_execute($stmt_check_nama_tematik);
//         mysqli_stmt_bind_result($stmt_check_nama_tematik, $nama_tematik_count);
//         mysqli_stmt_fetch($stmt_check_nama_tematik);
//         mysqli_stmt_close($stmt_check_nama_tematik);

//         if ($nama_tematik_count > 0) {
//             echo "<script>alert('Data gagal dikirim! Nama data sudah ada dalam database');</script>";
//             echo "<script>window.location.href = 'daftar-tematik';</script>"; // Redirect kembali
//             exit;
//         }

//         // Cek apakah checkbox_id sudah ada dalam database
//         $query_check_checkbox_id = "SELECT COUNT(*) FROM tematik WHERE checkbox_id = ?";
//         $stmt_check_checkbox_id = mysqli_prepare($conn, $query_check_checkbox_id);
//         mysqli_stmt_bind_param($stmt_check_checkbox_id, 's', $checkbox_id);
//         mysqli_stmt_execute($stmt_check_checkbox_id);
//         mysqli_stmt_bind_result($stmt_check_checkbox_id, $checkbox_id_count);
//         mysqli_stmt_fetch($stmt_check_checkbox_id);
//         mysqli_stmt_close($stmt_check_checkbox_id);

//         if ($checkbox_id_count > 0) {
//             echo "<script>alert('Data gagal dikirim! Checkbox ID sudah ada dalam database');</script>";
//             echo "<script>window.location.href = 'daftar-tematik';</script>"; // Redirect kembali
//             exit;
//         }

//         // Pindahkan file ke direktori tujuan
//         $upload_dir = '../assets/geojson/tematik/';
//         $upload_path = $upload_dir . $file_name;
//         if (move_uploaded_file($file_tmp, $upload_path)) {
//             // Memasukkan data ke tabel tematik
//             $query = "INSERT INTO tematik (nama_tematik, file_json, checkbox_id, kategori , id_jenis_file) VALUES (?, ?, ?, ?, ?)";

//             $stmt = mysqli_prepare($conn, $query);

//             // Tambahkan tipe data untuk id_jenis_file yang merupakan integer ('i')
//             mysqli_stmt_bind_param($stmt, 'ssssi', $nama_tematik, $file_name, $checkbox_id, $kategori, $id_jenis_file);

//             // Menjalankan query
//             if (mysqli_stmt_execute($stmt)) {
//                 mysqli_stmt_close($stmt);
//                 mysqli_close($conn);
//                 echo "<script>alert('Data berhasil ditambahkan ke tabel tematik');</script>";
//                 echo "<script>window.location.href = 'daftar-tematik';</script>";
//                 exit;
//             } else {
//                 echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
//             }
//             mysqli_stmt_close($stmt);
//         } else {
//             echo "<script>alert('Gagal mengunggah file GeoJSON');</script>";
//         }
//     } else {
//         echo "<script>alert('Mohon pilih file GeoJSON yang valid');</script>";
//     }
// }

$nama_halaman = 'Tambah tematik';
$linkcss = 'tambah-tematik.css';
require 'views/tambah-tematik.view.php';