<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM rencana");

$i = 0;

$nama_halaman = 'Daftar rencana';
$linkcss = 'daftar-rencana.css';
require 'views/daftar-rencana.view.php';
