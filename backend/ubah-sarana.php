<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM sarana ORDER BY sarana.nama_sarana ASC");

$i = 0;

$nama_halaman = 'Update sarana';
$linkcss = 'ubah-sarana.css';
require 'views/ubah-sarana.view.php';
