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

$nama_halaman = 'Update data pokok tematik';
$linkcss = 'daftar-tematik.css';
require 'views/update-data-pokok-tematik.view.php';
