<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_rencana");

$i = 1;

$nama_halaman = 'Update data atribut rencana';
$linkcss = 'daftar-rencana.css';
require 'views/update-data-atribut-rencana.view.php';
