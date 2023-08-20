<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data prasarana';
$linkcss = 'tambah-baru-prasarana.css';
require 'views/tambah-baru-prasarana.view.php';
