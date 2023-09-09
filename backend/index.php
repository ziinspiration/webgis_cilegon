<?php
session_start();

$id_admin = "";
$nama = "";

if (isset($_SESSION["id"])) {
    $id_admin = $_SESSION["id"];
}

if (isset($_SESSION["nama_pegawai"])) {
    $nama = $_SESSION["nama_pegawai"];
} elseif (isset($_COOKIE["nama_pegawai"])) {
    $nama = $_COOKIE["nama_pegawai"];
}

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getnama = query("SELECT nama_pegawai FROM admin WHERE id = $id_admin");

if ($getnama && isset($getnama[0]['nama_pegawai'])) {
    $nama_pegawai = $getnama[0]['nama_pegawai'];
} else {
    $nama_pegawai = '';
}


$nama_halaman = 'Dashboard admin';
$linkcss = 'index.css';
require 'views/index.view.php';
