<?php
require_once 'functions/functions.php';

$getTematik = query("SELECT * FROM tematik");
$getRencana = query("SELECT * FROM rencana");

$nama_halaman = 'Map tematik';
$linkcss = 'tematik.css';
require 'views/mapTematik.view.php';
