<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getjenisfile = query("SELECT * FROM jenis_file;");
$getjenisrencana = query("SELECT * FROM jenis_rencana;");

$nama_halaman = 'Tambah rencana';
$linkcss = 'tambah-rencana.css';
require 'views/tambah-rencana.view.php';
