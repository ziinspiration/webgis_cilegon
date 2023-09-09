<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getkategori = query("SELECT * FROM kategori_data");
$getjenis = query("SELECT * FROM jenis_sarana");

$nama_halaman = 'Tambah sarana';
$linkcss = 'tambah-sarana.css';
require 'views/tambah-sarana.view.php';
