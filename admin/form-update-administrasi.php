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

// query data administrasi berdasarkan id
$getdata = query("SELECT * FROM administrasi WHERE id = $id")[0];

$nama_halaman = 'Form update administrasi';
$linkcss = 'form-update-administrasi.css';
require 'views/form-update-administrasi.view.php';
