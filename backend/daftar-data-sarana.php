<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_sarana");

$i = 1;

$nama_halaman = 'Daftar sarana';
$linkcss = 'daftar-sarana.css';
require 'views/daftar-data-sarana.view.php';
