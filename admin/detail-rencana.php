<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET["id"];

$getdata = query("SELECT r.*, j.nama_jenis
                 FROM rencana AS r
                 LEFT JOIN jenis_file AS j ON r.id_jenis_file = j.id;")[0];
$i = 0;

$nama_halaman = 'Daftar rencana';
$linkcss = 'detail-rencana.css';
require 'views/detail-rencana.view.php';
