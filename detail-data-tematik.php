<?php
require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_tematik 
                  JOIN data_tematik ON atribut_tematik.data_pokok_id = data_tematik.id 
                  WHERE atribut_tematik.data_pokok_id = $id");

$i = 1;

$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = 'Detail data tematik';
require 'views/detail-data-tematik.view.php';
