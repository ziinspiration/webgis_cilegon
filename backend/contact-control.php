<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getAlamat = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'Alamat'");
$getEmail = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'Email'");
$getPhone = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'Nomor telepon'");
$getkoordinat = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'Koordinat'");

$nama_halaman = 'Media sosial control';
$linkcss = 'contact-control.css';
require 'views/contact-control.view.php';
