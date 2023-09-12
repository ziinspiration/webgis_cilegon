<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}
require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM jenis_legenda");
$getlegenda = query("SELECT * FROM legenda JOIN jenis_legenda ON legenda.jenis_id = jenis_legenda.id_jenis");

$i = 1;

$nama_halaman = 'Data Legenda';
$linkcss = 'data-legenda.css';
require 'views/data-legenda.view.php';
