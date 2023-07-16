<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Daftar prasarana';
$linkcss = 'daftar-prasarana.css';
require 'views/daftar-prasarana.view.php';
