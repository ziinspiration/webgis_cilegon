<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_rencana 
                  JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id 
                  WHERE atribut_rencana.data_pokok_id = $id");

$i = 0;

$nama_halaman = 'Daftar rencana';
$linkcss = 'detail-rencana.css';
require 'views/detail-data-rencana.view.php';
