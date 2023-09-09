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

// query data tematik berdasarkan id
$getdata = query("SELECT * FROM atribut_tematik WHERE id = $id")[0];

$nama_halaman = 'Form update atribut tematik';
$linkcss = 'form-update-tematik.css';
require 'views/form-update-atribut-tematik.view.php';
