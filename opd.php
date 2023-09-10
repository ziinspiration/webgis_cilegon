<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM skpd ORDER BY nama_dinas ASC");

$i = 1;

$nama_halaman = 'OPD';
$linkcss = 'skpd.css';
$folder = 'DATA UMUM';
$name_page = 'Data OPD';
require 'views/opd.view.php';
