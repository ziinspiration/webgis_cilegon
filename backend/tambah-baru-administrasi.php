<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data administrasi';
$linkcss = 'tambah-baru-administrasi.css';
require 'views/tambah-baru-administrasi.view.php';
