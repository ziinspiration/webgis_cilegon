<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_sarana");

$i = 1;

$nama_halaman = 'Update data atribut sarana';
$linkcss = 'daftar-sarana.css';
require 'views/update-data-atribut-sarana.view.php';
