<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getjenisfile = query("SELECT * FROM jenis_file");
$getjenisprasarana = query("SELECT * FROM jenis_prasarana");

$nama_halaman = 'Tambah prasarana';
$linkcss = 'tambah-prasarana.css';
require 'views/tambah-prasarana.view.php';
