<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id_data = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_prasarana 
                  JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id 
                  WHERE atribut_prasarana.data_pokok_id = $id_data");

$i = 1;

$nama_halaman = 'Tambah data atribut prasarana';
$linkcss = 'tambah-data-atribut-prasarana.css';
require 'views/tambah-data-atribut-prasarana.view.php';
