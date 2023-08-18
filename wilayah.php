<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM wilayah ORDER BY kecamatan ASC");

$nama_halaman = 'Wilayah';
$linkcss = 'wilayah.css';
$folder = 'REFERENSI';
$name_page = 'Wilayah';
require 'views/wilayah.view.php';
