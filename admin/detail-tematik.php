<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM tematik WHERE id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar tematik';
$linkcss = 'detail-tematik.css';
require 'views/detail-tematik.view.php';
