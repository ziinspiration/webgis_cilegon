<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: login");
  exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT 
                    atribut_rencana.id AS id_atribut, 
                    atribut_rencana.data_pokok_id AS id_pokok, 
                    data_rencana.id AS id_data, 
                    atribut_rencana.*, 
                    data_rencana.* 
                  FROM atribut_rencana 
                  JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id 
                  WHERE atribut_rencana.data_pokok_id = $id");

$i = 0;

$nama_halaman = 'Update atribut rencana';
$linkcss = 'detail-rencana.css';
require 'views/ubah-atribut-rencana.view.php';
