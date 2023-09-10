<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require_once 'functions/functions.php';

$conn = koneksi();

$i = 1;

$getdata = query("SELECT *, SUBSTRING(isi, 1, 50) AS isi_terbatas FROM saran_kritik");


$nama_halaman = 'Kritik & Saran';
$linkcss = 'kritik-saran.css';
require 'views/kritik-saran.view.php';
