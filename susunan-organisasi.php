<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM struktur_organisasi");

$i = 1;

$nama_halaman = 'Susunan Organisasi';
$linkcss = 'skpd.css';
$folder = 'DATA UMUM';
$name_page = 'Susunan Organisasi';
require 'views/susunan-organisasi.view.php';