<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM prasarana ORDER BY prasarana.nama_prasarana ASC");

$i = 0;

$nama_halaman = 'Update prasarana';
$linkcss = 'ubah-prasarana.css';
require 'views/ubah-prasarana.view.php';
