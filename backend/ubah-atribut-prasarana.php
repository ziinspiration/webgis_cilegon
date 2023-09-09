<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("location: ../auth/login");
  exit;
}

require 'functions/functions.php';

$conn = koneksi();

$id = $_GET['id']; // Mengambil ID dari parameter URL

$getdata = query("SELECT 
                    atribut_prasarana.id AS id_atribut, 
                    atribut_prasarana.data_pokok_id AS id_pokok, 
                    data_prasarana.id AS id_data, 
                    atribut_prasarana.*, 
                    data_prasarana.* 
                  FROM atribut_prasarana 
                  JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id 
                  WHERE atribut_prasarana.data_pokok_id = $id");

$i = 0;

$nama_halaman = 'Update atribut prasarana';
$linkcss = 'detail-prasarana.css';
require 'views/ubah-atribut-prasarana.view.php';
