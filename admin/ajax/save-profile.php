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

// Menyimpan perubahan data pengguna ke dalam database
$query = "UPDATE admin SET nik = '$nik', nama_pegawai = '$nama_pegawai' WHERE id = $admin_id";
mysqli_query($conn, $query);

// Proses perubahan gambar profil jika ada
if (isset($_POST['foto_profile'])) {
    $foto_profile = $_POST['foto_profile'];

    // Ubah format base64 menjadi file gambar dan simpan di server
    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $foto_profile));
    $imagePath = '../../assets/profile_picture/' . $admin_id . '.jpg'; // Ganti dengan path yang sesuai

    file_put_contents($imagePath, $imageData);
}

mysqli_close($conn);
