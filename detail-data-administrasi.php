<?php
require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT * FROM atribut_administrasi 
                  JOIN data_administrasi ON atribut_administrasi.data_pokok_id = data_administrasi.id 
                  WHERE atribut_administrasi.data_pokok_id = $id");

$i = 1;

$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = 'Detail data administrasi';
require 'views/detail-data-adm.view.php';
