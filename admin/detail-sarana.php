<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE sarana.id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar sarana';
$linkcss = 'detail-sarana.css';
require 'views/detail-sarana.view.php';
