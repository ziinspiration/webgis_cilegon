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
                    atribut_sarana.id AS id_atribut, 
                    data_sarana.id AS id_data, 
                    atribut_sarana.*, 
                    data_sarana.* 
                  FROM atribut_sarana 
                  JOIN data_sarana ON atribut_sarana.data_pokok_id = data_sarana.id 
                  WHERE atribut_sarana.data_pokok_id = $id");

$i = 0;

$nama_halaman = 'Update atribut sarana';
$linkcss = 'detail-sarana.css';
require 'views/ubah-atribut-sarana.view.php';
