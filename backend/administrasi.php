<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Administrasi';
$linkcss = 'administrasi.css';
require 'views/administrasi.view.php';
