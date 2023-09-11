<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM struktur_organisasi");

$i = 1;

$nama_halaman = 'Struktur Organisasi';
$linkcss = 'skpd.css';
$folder = 'DATA UMUM';
$name_page = 'Struktur Organisasi';
require 'views/struktur-organisasi.view.php';
