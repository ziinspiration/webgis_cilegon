<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_rencana");

$i = 1;

$nama_halaman = 'Tambah data rencana';
$linkcss = 'tambah-atribut-rencana.css';
require 'views/tambah-atribut-rencana.view.php';
