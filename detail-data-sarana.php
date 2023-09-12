<?php
session_start();

require 'functions/functions.php';

$conn = koneksi();

$id = $_SESSION["id"];
$nama_data = $_SESSION["nama_data"];

$getdata = query("SELECT * FROM atribut_sarana 
                  JOIN data_sarana ON atribut_sarana.data_pokok_id = data_sarana.id 
                  WHERE atribut_sarana.data_pokok_id = $id");

$i = 1;

$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = "Detail data sarana > $nama_data";
require 'views/detail-data-sarana.view.php';
