<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data skpd';
$linkcss = 'tambah-skpd.css';
require 'views/tambah-skpd.view.php';
