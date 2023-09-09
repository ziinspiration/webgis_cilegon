<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data publikasi';
$linkcss = 'data-publikasi.css';
require 'views/publikasi.view.php';
