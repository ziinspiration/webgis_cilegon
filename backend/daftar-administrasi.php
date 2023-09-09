<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}
require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM administrasi");

$i = 0;

$nama_halaman = 'Daftar administrasi';
$linkcss = 'daftar-administrasi.css';
require 'views/daftar-administrasi.view.php';
