<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE sarana.id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar sarana';
$linkcss = 'detail-sarana.css';
require 'views/detail-sarana.view.php';
