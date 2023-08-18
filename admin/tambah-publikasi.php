<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data publikasi';
$linkcss = 'tambah-publikasi.css';
require 'views/tambah-publikasi.view.php';
