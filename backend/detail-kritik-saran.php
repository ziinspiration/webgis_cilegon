<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id'];

$getdata = query("SELECT * FROM saran_kritik WHERE id = $id");

$i = 0;

$nama_halaman = 'Daftar kritik & Saran';
$linkcss = 'detail-kritik-saran.css';
require 'views/detail-kritik-saran.view.php';
