<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$admin_id = $_SESSION["id"];

$query = "SELECT * FROM admin WHERE id = $admin_id";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

$nama_halaman = 'Profile admin';
$linkcss = 'profile-admin.css';
require 'views/profile-admin.view.php';
