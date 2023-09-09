<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM publikasi");

$i = 0;

$nama_halaman = 'Update publikasi';
$linkcss = 'ubah-publikasi.css';
require 'views/ubah-publikasi.view.php';
