<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM tematik JOIN kategori_tematik ON tematik.kategori = kategori_tematik.id_kategori ORDER BY tematik.nama_tematik ASC");

$i = 0;

$nama_halaman = 'Daftar tematik';
$linkcss = 'daftar-tematik.css';
require 'views/daftar-tematik.view.php';
