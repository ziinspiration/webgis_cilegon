<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM prasarana WHERE id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar prasarana';
$linkcss = 'detail-prasarana.css';
require 'views/detail-prasarana.view.php';
