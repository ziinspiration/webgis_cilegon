<?php
session_start();

require 'functions/functions.php';

$conn = koneksi();

$id = $_SESSION["id"];
$nama_data = $_SESSION["nama_data"];

$getdata = query("SELECT * FROM atribut_prasarana 
                  JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id 
                  WHERE atribut_prasarana.data_pokok_id = $id");

$i = 1;

$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = "Detail data prasarana > $nama_data";
require 'views/detail-data-prasarana.view.php';
