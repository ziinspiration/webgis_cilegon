<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data sarana';
$linkcss = 'tambah-baru-sarana.css';
require 'views/tambah-baru-sarana.view.php';
