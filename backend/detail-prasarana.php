<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM prasarana JOIN jenis_file ON prasarana.id_jenis = jenis_file.jenis_file_id WHERE id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar prasarana';
$linkcss = 'detail-prasarana.css';
require 'views/detail-prasarana.view.php';
