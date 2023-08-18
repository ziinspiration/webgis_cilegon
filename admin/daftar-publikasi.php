<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM publikasi");

$i = 1;

$nama_halaman = 'Daftar publikasi';
$linkcss = 'daftar-publikasi.css';
require 'views/daftar-publikasi.view.php';
