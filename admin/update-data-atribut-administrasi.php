<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_administrasi");

$i = 1;

$nama_halaman = 'Update data atribut administrasi';
$linkcss = 'daftar-administrasi.css';
require 'views/update-data-atribut-administrasi.view.php';
