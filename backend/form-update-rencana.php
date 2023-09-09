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

// query data rencana berdasarkan id
$getdata = query("SELECT * FROM rencana WHERE id = $id")[0];

$nama_halaman = 'Form update rencana';
$linkcss = 'form-update-rencana.css';
require 'views/form-update-rencana.view.php';
