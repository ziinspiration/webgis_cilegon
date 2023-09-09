<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id_data = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_administrasi 
                  JOIN data_administrasi ON atribut_administrasi.data_pokok_id = data_administrasi.id 
                  WHERE atribut_administrasi.data_pokok_id = $id_data");

$i = 1;

$nama_halaman = 'Tambah data atribut administrasi';
$linkcss = 'tambah-data-atribut-administrasi.css';
require 'views/tambah-data-atribut-administrasi.view.php';
