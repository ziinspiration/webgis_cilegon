<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data rencana';
$linkcss = 'tambah-baru-rencana.css';
require 'views/tambah-baru-rencana.view.php';
