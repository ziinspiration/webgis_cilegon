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

// query data prasarana berdasarkan id
$getdata = query("SELECT * FROM prasarana WHERE id = $id")[0];

$nama_halaman = 'Form update prasarana';
$linkcss = 'form-update-prasarana.css';
require 'views/form-update-prasarana.view.php';
