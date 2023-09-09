<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update data prasarana';
$linkcss = 'ubah-data-prasarana.css';
require 'views/ubah-data-prasarana.view.php';
