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
$getdata = query("SELECT * FROM atribut_rencana WHERE id = $id")[0];

$nama_halaman = 'Form update atribut rencana';
$linkcss = 'form-update-rencana.css';
require 'views/form-update-atribut-rencana.view.php';
