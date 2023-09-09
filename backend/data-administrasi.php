<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data Administrasi';
$linkcss = 'data-administrasi.css';
require 'views/data-administrasi.view.php';
