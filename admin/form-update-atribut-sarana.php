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

// query data sarana berdasarkan id
$getdata = query("SELECT * FROM atribut_sarana WHERE id = $id")[0];

$nama_halaman = 'Form update atribut sarana';
$linkcss = 'form-update-sarana.css';
require 'views/form-update-atribut-sarana.view.php';
