<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah prasarana';
$linkcss = 'tambah-prasarana.css';
require 'views/tambah-prasarana.view.php';
