<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM admin");

$i = 0;

$nama_halaman = 'Daftar admin';
$linkcss = 'daftar-akun.css';
require 'views/daftar-akun.view.php';
