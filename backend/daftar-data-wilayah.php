<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM wilayah");

$i = 1;

$nama_halaman = 'Daftar wilayah';
$linkcss = 'daftar-wilayah.css';
require 'views/daftar-wilayah.view.php';
