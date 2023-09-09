<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_sarana 
                  JOIN data_sarana ON atribut_sarana.data_pokok_id = data_sarana.id 
                  WHERE atribut_sarana.data_pokok_id = $id");

$i = 0;

$nama_halaman = 'Daftar sarana';
$linkcss = 'detail-sarana.css';
require 'views/detail-data-sarana.view.php';
