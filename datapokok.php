<?php
require 'functions/functions.php';

$conn = koneksi();

$getadministrasi = query("SELECT * FROM data_administrasi");
$gettematik = query("SELECT * FROM data_tematik");

$nama_halaman = 'Data pokok';
$linkcss = 'datapokok.css';
$folder = 'DATA POKOK';
$name_page = 'Data';
require 'views/datapokok.view.php';
