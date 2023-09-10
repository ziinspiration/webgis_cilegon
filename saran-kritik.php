<?php
require_once 'functions/functions.php';

$getdata = query("SELECT * FROM saran_kritik");

$nama_halaman = 'Saran & Kritik';
$linkcss = 'saran-kritik.css';
$folder = 'INFORMASI & PUBLIKASI';
$name_page = 'Saran & Kritik';
require 'views/saran-kritik.view.php';
