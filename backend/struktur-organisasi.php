<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}
require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM struktur_organisasi");

$nama_halaman = 'Struktur Organisasi';
$linkcss = 'struktur-organisasi.css';
require 'views/struktur-organisasi.view.php';
