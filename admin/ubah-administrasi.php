<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update administrasi';
$linkcss = 'ubah-administrasi.css';
require 'views/ubah-administrasi.view.php';
