<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data rencana';
$linkcss = 'tambah-data-rencana.css';
require 'views/tambah-data-rencana.view.php';
