<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];
$getdata = query("SELECT * FROM admin WHERE id = $id")[0];

$i = 0;

$nama_halaman = 'Daftar admin';
$linkcss = 'detail-admin.css';
require 'views/detail-admin.view.php';
