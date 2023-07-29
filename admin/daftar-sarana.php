<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori ORDER BY sarana.nama_sarana ASC");

$i = 0;

$nama_halaman = 'Daftar sarana';
$linkcss = 'daftar-sarana.css';
require 'views/daftar-sarana.view.php';
