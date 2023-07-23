<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT r.*, j.nama_jenis
                 FROM rencana AS r
                 JOIN jenis_file AS j ON r.id_jenis_file = j.id;");

$i = 0;

$nama_halaman = 'Update rencana';
$linkcss = 'ubah-rencana.css';
require 'views/ubah-rencana.view.php';
