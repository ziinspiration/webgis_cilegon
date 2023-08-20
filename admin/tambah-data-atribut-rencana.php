<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id_data = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_rencana 
                  JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id 
                  WHERE atribut_rencana.data_pokok_id = $id_data");

$i = 1;

$nama_halaman = 'Tambah data atribut rencana';
$linkcss = 'tambah-data-atribut-rencana.css';
require 'views/tambah-data-atribut-rencana.view.php';
