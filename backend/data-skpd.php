<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data skpd';
$linkcss = 'data-skpd.css';
require 'views/data-skpd.view.php';
