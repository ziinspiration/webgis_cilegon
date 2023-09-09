<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM skpd");

$i = 1;

$nama_halaman = 'Daftar SKPD';
$linkcss = 'daftar-skpd.css';
require 'views/daftar-skpd.view.php';
