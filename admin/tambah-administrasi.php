<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah administrasi';
$linkcss = 'tambah-administrasi.css';
require 'views/tambah-administrasi.view.php';
