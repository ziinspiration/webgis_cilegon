<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM wilayah ORDER BY kecamatan ASC");

$nama_halaman = 'Wilayah';
$linkcss = 'wilayah.css';
$folder = 'DATA RUJUKAN';
$name_page = 'Data Kewilayahan';
require 'views/wilayah.view.php';
