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

$nama_halaman = 'Update data pokok rencana';
$linkcss = 'daftar-rencana.css';
require 'views/update-data-pokok-rencana.view.php';
