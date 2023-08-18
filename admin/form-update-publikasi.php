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

// query data publikasi berdasarkan id
$getdata = query("SELECT * FROM publikasi WHERE id = $id")[0];

$nama_halaman = 'Form update publikasi';
$linkcss = 'form-update-publikasi.css';
require 'views/form-update-publikasi.view.php';
