<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM data_administrasi");

$i = 1;

$nama_halaman = 'Tambah data administrasi';
$linkcss = 'tambah-atribut-administrasi.css';
require 'views/tambah-atribut-administrasi.view.php';
