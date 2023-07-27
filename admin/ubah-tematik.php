<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM tematik ORDER BY tematik.nama_tematik ASC");

$i = 0;

$nama_halaman = 'Update tematik';
$linkcss = 'ubah-tematik.css';
require 'views/ubah-tematik.view.php';
