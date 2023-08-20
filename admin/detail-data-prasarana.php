<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_prasarana 
                  JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id 
                  WHERE atribut_prasarana.data_pokok_id = $id");

$i = 0;

$nama_halaman = 'Daftar prasarana';
$linkcss = 'detail-prasarana.css';
require 'views/detail-data-prasarana.view.php';
