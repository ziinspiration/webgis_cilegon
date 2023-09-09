<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getKategori = query("SELECT * FROM kategori_tematik");
$getJenisFile = query("SELECT * FROM jenis_file WHERE nama_jenis <> 'Marker'");

$nama_halaman = 'Tambah tematik';
$linkcss = 'tambah-tematik.css';
require 'views/tambah-tematik.view.php';
