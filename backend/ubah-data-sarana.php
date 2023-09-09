<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update data sarana';
$linkcss = 'ubah-data-sarana.css';
require 'views/ubah-data-sarana.view.php';
