<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

// ambil data di URL
$id = $_GET["id"];

// query data sarana berdasarkan id
$getdata = query("SELECT * FROM sarana WHERE id = $id")[0];

$getkategori = query("SELECT DISTINCT kategori FROM sarana");

$nama_halaman = 'Form update sarana';
$linkcss = 'form-update-sarana.css';
require 'views/form-update-sarana.view.php';
