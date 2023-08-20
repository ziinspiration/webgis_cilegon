<?php
require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_prasarana 
                  JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id 
                  WHERE atribut_prasarana.data_pokok_id = $id");


$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = 'Detail data prasarana';
require 'views/detail-data-prasarana.view.php';
