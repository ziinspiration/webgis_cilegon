<?php
require 'functions/functions.php';

$conn = koneksi();

$getadministrasi = query("SELECT * FROM data_administrasi ORDER BY nama_data");
$gettematik = query("SELECT * FROM data_tematik ORDER BY nama_data");
$getrencana = query("SELECT * FROM data_rencana ORDER BY nama_data");
$getprasarana = query("SELECT * FROM data_prasarana ORDER BY nama_data");
$getsarana = query("SELECT * FROM data_sarana ORDER BY nama_data");


$nama_halaman = 'Data tabular';
$linkcss = 'datapokok.css';
$folder = 'DATA TABULAR';
$name_page = 'Data Pokok';
require 'views/datatabular.view.php';
