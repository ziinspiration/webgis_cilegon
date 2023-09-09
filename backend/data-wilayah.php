<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data wilayah';
$linkcss = 'data-wilayah.css';
require 'views/data-wilayah.view.php';
