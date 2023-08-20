<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tambah data prasarana';
$linkcss = 'tambah-data-prasarana.css';
require 'views/tambah-data-prasarana.view.php';
