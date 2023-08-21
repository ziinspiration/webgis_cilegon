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
                    atribut_administrasi.id AS id_atribut, 
                    data_administrasi.id AS id_data, 
                    atribut_administrasi.*, 
                    data_administrasi.* 
                  FROM atribut_administrasi 
                  JOIN data_administrasi ON atribut_administrasi.data_pokok_id = data_administrasi.id 
                  WHERE atribut_administrasi.data_pokok_id = $id");



$i = 0;

$nama_halaman = 'Update atribut administrasi';
$linkcss = 'detail-administrasi.css';
require 'views/ubah-atribut-administrasi.view.php';
