<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id_data = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_tematik 
                  JOIN data_tematik ON atribut_tematik.data_pokok_id = data_tematik.id 
                  WHERE atribut_tematik.data_pokok_id = $id_data");

$i = 1;

$nama_halaman = 'Tambah data atribut tematik';
$linkcss = 'tambah-data-atribut-tematik.css';
require 'views/tambah-data-atribut-tematik.view.php';
