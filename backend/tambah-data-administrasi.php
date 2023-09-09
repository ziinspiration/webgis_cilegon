<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data administrasi';
$linkcss = 'tambah-data-administrasi.css';
require 'views/tambah-data-administrasi.view.php';
