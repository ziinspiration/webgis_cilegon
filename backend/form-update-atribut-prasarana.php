<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

// ambil data di URL
$id = $_GET["id"];

// query data prasarana berdasarkan id
$getdata = query("SELECT * FROM atribut_prasarana WHERE id = $id")[0];

$nama_halaman = 'Form update atribut prasarana';
$linkcss = 'form-update-prasarana.css';
require 'views/form-update-atribut-prasarana.view.php';
