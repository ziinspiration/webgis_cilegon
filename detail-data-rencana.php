<?php
require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_rencana 
                  JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id 
                  WHERE atribut_rencana.data_pokok_id = $id");


$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = 'Detail data rencana';
require 'views/detail-data-rencana.view.php';
