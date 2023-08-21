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
                    atribut_tematik.id AS id_atribut, 
                    data_tematik.id AS id_data, 
                    atribut_tematik.*, 
                    data_tematik.* 
                  FROM atribut_tematik 
                  JOIN data_tematik ON atribut_tematik.data_pokok_id = data_tematik.id 
                  WHERE atribut_tematik.data_pokok_id = $id");

$i = 0;

$nama_halaman = 'Update atribut tematik';
$linkcss = 'detail-tematik.css';
require 'views/ubah-atribut-tematik.view.php';
