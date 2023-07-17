<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

// Ambil nama dari session atau cookie
$nama = "";
if (isset($_SESSION["nama_pegawai"])) {
    $nama = $_SESSION["nama_pegawai"];
} elseif (isset($_COOKIE["nama_pegawai"])) {
    $nama = $_COOKIE["nama_pegawai"];
}

$nama_halaman = 'Profile admin';
$linkcss = 'profile-admin.css';
require 'views/profile-admin.view.php';
