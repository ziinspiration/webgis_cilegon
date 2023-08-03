<?php
require_once 'functions/functions.php';

$getTematik = query("SELECT * FROM tematik ORDER BY nama_tematik ASC");
$getRencana = query("SELECT * FROM rencana ORDER BY nama_rencana ASC");

$nama_halaman = 'Map tematik';
$linkcss = 'tematik.css';
require 'views/mapTematik.view.php';
