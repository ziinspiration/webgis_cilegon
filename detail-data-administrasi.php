<?php
session_start();

require 'functions/functions.php';

$conn = koneksi();

$id = $_SESSION["id"];
$nama_data = $_SESSION["nama_data"];

$getdata = query("SELECT * FROM atribut_administrasi 
                  JOIN data_administrasi ON atribut_administrasi.data_pokok_id = data_administrasi.id 
                  WHERE atribut_administrasi.data_pokok_id = $id");

$i = 1;


$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = "Detail data administrasi > $nama_data";
require 'views/detail-data-adm.view.php';
