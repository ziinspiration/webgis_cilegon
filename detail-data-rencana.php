<?php
session_start();

require 'functions/functions.php';

$conn = koneksi();

$id = $_SESSION["id"];
$nama_data = $_SESSION["nama_data"];

$getdata = query("SELECT * FROM atribut_rencana 
                  JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id 
                  WHERE atribut_rencana.data_pokok_id = $id");

$i = 1;

$nama_halaman = 'Data detail';
$linkcss = 'datadetail.css';
$folder = 'DATA POKOK';
$name_page = "Detail data rencana > $nama_data";
require 'views/detail-data-rencana.view.php';
