<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_rencana");

$i = 1;

$nama_halaman = 'Daftar rencana';
$linkcss = 'daftar-rencana.css';
require 'views/daftar-data-rencana.view.php';
