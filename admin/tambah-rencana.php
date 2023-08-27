<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getjenisfile = query("SELECT * FROM jenis_file;");
$getjenisrencana = query("SELECT * FROM jenis_rencana;");

// if (isset($_POST['send'])) {
//     // Mendapatkan data dari form
//     $nama_rencana = htmlspecialchars($_POST['nama_rencana']);
//     $id_jenis_file = $_POST['id_jenis_file'];

//     // Atur nilai icon dan icon_id menjadi 0 jika jenis file adalah "marker" (ID 1)
//     $icon = ($id_jenis_file == 1 && isset($_POST['icon'])) ? htmlspecialchars($_POST['icon']) : '0';
//     $icon_id = ($id_jenis_file == 1) ? htmlspecialchars($_POST['icon_id']) : '0';

//     $checkbox_id = htmlspecialchars($_POST['checkbox_id']);

//     // Cek apakah file JSON telah diunggah
//     if (isset($_FILES['file_json']) && $_FILES['file_json']['error'] === UPLOAD_ERR_OK) {
//         // Mendapatkan informasi file JSON
//         $file_name = $_FILES['file_json']['name'];
//         $file_tmp = $_FILES['file_json']['tmp_name'];

//         // Cek apakah nama_rencana sudah ada dalam database
//         $query_check_nama_rencana = "SELECT COUNT(*) FROM rencana WHERE nama_rencana = ?";
//         $stmt_check_nama_rencana = mysqli_prepare($conn, $query_check_nama_rencana);
//         mysqli_stmt_bind_param($stmt_check_nama_rencana, 's', $nama_rencana);
//         mysqli_stmt_execute($stmt_check_nama_rencana);
//         mysqli_stmt_bind_result($stmt_check_nama_rencana, $nama_rencana_count);
//         mysqli_stmt_fetch($stmt_check_nama_rencana);
//         mysqli_stmt_close($stmt_check_nama_rencana);

//         if ($nama_rencana_count > 0) {
//             echo "<script>alert('Data gagal dikirim! Nama data sudah ada dalam database');</script>";
//             echo "<script>window.location.href = 'daftar-rencana';</script>"; // Redirect kembali
//             exit;
//         }

//         // Cek apakah checkbox_id sudah ada dalam database
//         $query_check_checkbox_id = "SELECT COUNT(*) FROM rencana WHERE checkbox_id = ?";
//         $stmt_check_checkbox_id = mysqli_prepare($conn, $query_check_checkbox_id);
//         mysqli_stmt_bind_param($stmt_check_checkbox_id, 's', $checkbox_id);
//         mysqli_stmt_execute($stmt_check_checkbox_id);
//         mysqli_stmt_bind_result($stmt_check_checkbox_id, $checkbox_id_count);
//         mysqli_stmt_fetch($stmt_check_checkbox_id);
//         mysqli_stmt_close($stmt_check_checkbox_id);

//         if ($checkbox_id_count > 0) {
//             echo "<script>alert('Data gagal dikirim! Checkbox ID sudah ada dalam database');</script>";
//             echo "<script>window.location.href = 'daftar-rencana';</script>"; // Redirect kembali
//             exit;
//         }

//         // Pindahkan file JSON ke direktori tujuan
//         $upload_dir = '../assets/geojson/rencana/';
//         $upload_path = $upload_dir . $file_name;
//         if (move_uploaded_file($file_tmp, $upload_path)) {
//             // Cek apakah file icon telah diunggah jika jenis file adalah "marker" (ID 1)
//             if ($id_jenis_file == 1 && isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
//                 // Mendapatkan informasi file icon
//                 $file_icon_name = $_FILES['icon']['name'];
//                 $file_icon_tmp = $_FILES['icon']['tmp_name'];

//                 // Mendapatkan ekstensi file icon
//                 $file_icon_ext = strtolower(pathinfo($file_icon_name, PATHINFO_EXTENSION));

//                 // Batasi jenis file yang diizinkan
//                 $allowed_icon_exts = array('png', 'jpg', 'jpeg');

//                 // Periksa apakah ekstensi file icon valid
//                 if (in_array($file_icon_ext, $allowed_icon_exts)) {
//                     // Pindahkan file icon ke direktori tujuan
//                     $upload_icon_dir = '../assets/icon/rencana/';
//                     $upload_icon_path = $upload_icon_dir . $file_icon_name;
//                     if (move_uploaded_file($file_icon_tmp, $upload_icon_path)) {
//                         $icon = $file_icon_name;
//                     } else {
//                         echo "<script>alert('Gagal mengunggah file icon');</script>";
//                     }
//                 } else {
//                     echo "<script>alert('Jenis file icon tidak valid');</script>";
//                 }
//             }

//             // Memasukkan data ke tabel rencana
//             $query = "INSERT INTO rencana (nama_rencana, file_json, icon, icon_id, checkbox_id, id_jenis_file) VALUES (?, ?, ?, ?, ?, ?)";
//             $stmt = mysqli_prepare($conn, $query);
//             mysqli_stmt_bind_param($stmt, 'ssssss', $nama_rencana, $file_name, $icon, $icon_id, $checkbox_id, $id_jenis_file);

//             // Menjalankan query
//             if (mysqli_stmt_execute($stmt)) {
//                 mysqli_stmt_close($stmt);
//                 mysqli_close($conn);
//                 echo "<script>alert('Data berhasil ditambahkan ke tabel rencana');</script>";
//                 echo "<script>window.location.href = 'daftar-rencana';</script>";
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

//     // Menutup koneksi database
//     mysqli_close($conn);
// }

$nama_halaman = 'Tambah rencana';
$linkcss = 'tambah-rencana.css';
require 'views/tambah-rencana.view.php';
