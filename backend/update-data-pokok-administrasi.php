<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_administrasi");

$i = 1;

$nama_halaman = 'Update data pokok administrasi';
$linkcss = 'daftar-administrasi.css';
require 'views/update-data-pokok-administrasi.view.php';
