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

$nama_halaman = 'Tambah data sarana';
$linkcss = 'tambah-atribut-sarana.css';
require 'views/tambah-atribut-sarana.view.php';
