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

// query data tematik berdasarkan id
$getdata = query("SELECT * FROM tematik WHERE id = $id")[0];

$nama_halaman = 'Form update tematik';
$linkcss = 'form-update-tematik.css';
require 'views/form-update-tematik.view.php';
