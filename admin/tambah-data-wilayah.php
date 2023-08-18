<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data wilayah';
$linkcss = 'tambah-wilayah.css';
require 'views/tambah-wilayah.view.php';
