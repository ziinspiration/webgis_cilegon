<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update data rencana';
$linkcss = 'ubah-data-rencana.css';
require 'views/ubah-data-rencana.view.php';
