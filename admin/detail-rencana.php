<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];

$getdata = query("SELECT * FROM rencana JOIN jenis_file ON rencana.id_jenis_file = jenis_file.jenis_file_id WHERE rencana.id = $id")[0];


$i = 0;

$nama_halaman = 'Daftar rencana';
$linkcss = 'detail-rencana.css';
require 'views/detail-rencana.view.php';
