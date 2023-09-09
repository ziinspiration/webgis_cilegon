<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id_data = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_sarana 
                  JOIN data_sarana ON atribut_sarana.data_pokok_id = data_sarana.id 
                  WHERE atribut_sarana.data_pokok_id = $id_data");

$i = 1;

$nama_halaman = 'Tambah data atribut sarana';
$linkcss = 'tambah-data-atribut-sarana.css';
require 'views/tambah-data-atribut-sarana.view.php';
