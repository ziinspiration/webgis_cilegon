<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data tematik';
$linkcss = 'tambah-baru-tematik.css';
require 'views/tambah-baru-tematik.view.php';