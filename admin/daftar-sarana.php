<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM sarana");

$i = 0;

$nama_halaman = 'Daftar sarana';
$linkcss = 'daftar-sarana.css';
require 'views/daftar-sarana.view.php';