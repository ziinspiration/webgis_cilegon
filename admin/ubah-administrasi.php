<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM administrasi");

$i = 0;

$nama_halaman = 'Update administrasi';
$linkcss = 'ubah-administrasi.css';
require 'views/ubah-administrasi.view.php';
