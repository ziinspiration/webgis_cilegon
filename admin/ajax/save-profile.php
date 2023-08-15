<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login");
    exit;
}

require '../functions/functions.php';

$conn = koneksi();

$admin_id = $_SESSION["id"];

// Mengambil data admin berdasarkan admin_id
$query = "SELECT * FROM admin WHERE id = $admin_id";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

// Mendapatkan data yang dikirim melalui permintaan POST
$nik = $_POST['nik'];
$nama_pegawai = $_POST['nama_pegawai'];

// Cek apakah data yang diubah sudah ada sebelumnya
$checkQuery = "SELECT * FROM admin WHERE nik = '$nik' AND id != $admin_id";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    // Data NIK sudah ada pada admin lain, tampilkan pesan alert
    mysqli_close($conn);
    echo '<script>alert("NIK sudah digunakan oleh admin lain. Perubahan tidak dapat dilakukan."); window.location.href = "../daftar-akun.php";</script>';
    exit;
}

// Process the uploaded profile picture if available
$new_foto_profile = '';
if (isset($_FILES['new_foto_profile']) && $_FILES['new_foto_profile']['error'] === UPLOAD_ERR_OK) {
    $foto_profile = $_FILES['new_foto_profile']['tmp_name'];
    $imagePath = '../../assets/profile_picture/' . $admin_id . '.jpg'; // Update the path and filename as needed
    move_uploaded_file($foto_profile, $imagePath);
    $new_foto_profile = $admin_id . '.jpg'; // Set the new filename
}

// Menyimpan perubahan data pengguna ke dalam database
$query = "UPDATE admin SET nik = '$nik', nama_pegawai = '$nama_pegawai', foto_profile = '$new_foto_profile' WHERE id = $admin_id";
mysqli_query($conn, $query);

mysqli_close($conn);
