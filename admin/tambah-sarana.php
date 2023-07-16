<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah sarana';
$linkcss = 'tambah-sarana.css';
require 'views/tambah-sarana.view.php';
