<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Daftar administrasi';
$linkcss = 'daftar-administrasi.css';
require 'views/daftar-administrasi.view.php';
