<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM prasarana");

$i = 0;

$nama_halaman = 'Daftar prasarana';
$linkcss = 'daftar-prasarana.css';
require 'views/daftar-prasarana.view.php';
