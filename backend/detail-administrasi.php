<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM administrasi WHERE id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar administrasi';
$linkcss = 'detail-administrasi.css';
require 'views/detail-administrasi.view.php';
