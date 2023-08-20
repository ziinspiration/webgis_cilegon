<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_prasarana");

$i = 1;

$nama_halaman = 'Tambah data prasarana';
$linkcss = 'tambah-atribut-prasarana.css';
require 'views/tambah-atribut-prasarana.view.php';