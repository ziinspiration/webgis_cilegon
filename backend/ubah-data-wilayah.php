<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM wilayah");

$i = 0;

$nama_halaman = 'Update wilayah';
$linkcss = 'ubah-wilayah.css';
require 'views/ubah-wilayah.view.php';
