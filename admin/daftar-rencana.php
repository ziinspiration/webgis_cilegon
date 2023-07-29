<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT r.*, j.nama_jenis
                 FROM rencana AS r
                 JOIN jenis_file AS j ON r.id_jenis_file = j.jenis_file_id ORDER BY r.nama_rencana ASC;");

$i = 0;

$nama_halaman = 'Daftar rencana';
$linkcss = 'daftar-rencana.css';
require 'views/daftar-rencana.view.php';
