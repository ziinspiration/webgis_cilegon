<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_prasarana");

$i = 1;

$nama_halaman = 'Daftar prasarana';
$linkcss = 'daftar-prasarana.css';
require 'views/daftar-data-prasarana.view.php';
