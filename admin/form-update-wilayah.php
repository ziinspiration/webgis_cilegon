<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

// ambil data di URL
$id = $_GET["id"];

// query data wilayah berdasarkan id
$getdata = query("SELECT * FROM wilayah WHERE id = $id")[0];

$nama_halaman = 'Form update wilayah';
$linkcss = 'form-update-wilayah.css';
require 'views/form-update-wilayah.view.php';
