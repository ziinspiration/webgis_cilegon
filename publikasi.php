<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM publikasi ORDER BY nama_data ASC");

$nama_halaman = 'PUBLIKASI';
$linkcss = 'publikasi.css';
$folder = 'INFORMASI PUBLIKASI';
$name_page = 'Data Publikasi';
require 'views/publikasi.view.php';
