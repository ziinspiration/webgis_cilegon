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

// query data skpd berdasarkan id
$getdata = query("SELECT * FROM skpd WHERE id = $id")[0];

$nama_halaman = 'Form update skpd';
$linkcss = 'form-update-skpd.css';
require 'views/form-update-skpd.view.php';
