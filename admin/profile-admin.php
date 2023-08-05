<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

// Mendapatkan admin_id dari session
$admin_id = $_SESSION["id"];

//ambil data admin berdasarkan id
$query = "SELECT * FROM admin WHERE id = $admin_id";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

$nama_halaman = 'Profile admin';
$linkcss = 'profile-admin.css';
require 'views/profile-admin.view.php';
