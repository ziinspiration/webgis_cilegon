<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM skpd ORDER BY nama_dinas ASC");

$i = 1;

$nama_halaman = 'SKPD';
$linkcss = 'skpd.css';
$folder = 'DATA RUJUKAN';
$name_page = 'Data SKPD';
require 'views/skpd.view.php';
