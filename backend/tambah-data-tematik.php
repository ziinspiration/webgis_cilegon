<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data tematik';
$linkcss = 'tambah-data-tematik.css';
require 'views/tambah-data-tematik.view.php';
