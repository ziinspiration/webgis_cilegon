<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM tematik JOIN kategori_tematik ON tematik.kategori = kategori_tematik.id_kategori JOIN jenis_file ON tematik.id_jenis_file = jenis_file.jenis_file_id WHERE id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar tematik';
$linkcss = 'detail-tematik.css';
require 'views/detail-tematik.view.php';
