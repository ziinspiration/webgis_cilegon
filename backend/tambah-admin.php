<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();


function registrasi($data)
{
    $conn = koneksi();

    // Bersihkan data masukan menggunakan fungsi clean_input
    $nik = clean_input(strtolower($data["nik"]));
    $password = clean_input(mysqli_real_escape_string($conn, $data["password"]));
    $password2 = clean_input(mysqli_real_escape_string($conn, $data["password2"]));
    $nama_admin = clean_input(mysqli_real_escape_string($conn, $data["nama_pegawai"]));
    $foto_profile = clean_input(mysqli_real_escape_string($conn, $data["foto_profile"]));

    $role = isset($data["role"]) ? clean_input(mysqli_real_escape_string($conn, $data["role"])) : 'basic';

    // Cek apakah NIK sudah ada atau belum
    $result = mysqli_query($conn, "SELECT nik FROM admin WHERE nik = '$nik'");

    if (mysqli_fetch_assoc($result)) {
        return array('status' => 'error', 'message' => 'Admin dengan NIP tersebut sudah terdaftar');
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        return array('status' => 'error', 'message' => 'Konfirmasi password tidak sesuai');
    }

    // Periksa kompleksitas password (minimal 8 karakter dengan kombinasi huruf, angka, dan simbol spesial)
    if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        return array('status' => 'error', 'message' => 'Password harus minimal 8 karakter dan terdiri dari angka, huruf, dan simbol spesial');
    }

    // Enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO admin VALUES(null,'$foto_profile','$nama_admin','$nik', '$password', '$role')");

    return array('status' => 'success', 'message' => 'Selamat registrasi admin berhasil !');
}


if (isset($_POST["register"])) {

    $result = registrasi($_POST);

    if ($result['status'] === 'success') {
        $message = array(
            'type' => 'success',
            'text' => $result['message']
        );
    } else {
        $message = array(
            'type' => 'danger',
            'text' => $result['message']
        );
    }
}

$nama_halaman = 'Tambah admin';
$linkcss = 'tambah-admin.css';
require 'views/tambah-admin.view.php';
