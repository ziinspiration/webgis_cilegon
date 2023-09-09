<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update data administrasi';
$linkcss = 'ubah-data-administrasi.css';
require 'views/ubah-data-administrasi.view.php';
