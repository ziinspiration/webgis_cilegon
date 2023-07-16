<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Daftar sarana';
$linkcss = 'daftar-sarana.css';
require 'views/daftar-sarana.view.php';
