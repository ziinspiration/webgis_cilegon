<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_tematik");

$i = 1;

$nama_halaman = 'Tambah data tematik';
$linkcss = 'tambah-atribut-tematik.css';
require 'views/tambah-atribut-tematik.view.php';
