<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_tematik");

$i = 1;

$nama_halaman = 'Daftar tematik';
$linkcss = 'daftar-tematik.css';
require 'views/daftar-data-tematik.view.php';
