<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update data tematik';
$linkcss = 'ubah-data-tematik.css';
require 'views/ubah-data-tematik.view.php';
