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

$nama_halaman = 'Update data atribut tematik';
$linkcss = 'daftar-tematik.css';
require 'views/update-data-atribut-tematik.view.php';
