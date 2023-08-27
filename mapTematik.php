<?php
require_once 'functions/functions.php';

$getTematik = query("SELECT * FROM tematik ORDER BY nama_tematik ASC");
$getrencanaA = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 1 ORDER BY nama_rencana ASC");
$getrencanaB = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 2 ORDER BY nama_rencana ASC");
$getrencanaC = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 3 ORDER BY nama_rencana ASC");
$getrencanaD = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 4 ORDER BY nama_rencana ASC");
$getrencanaE = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 5 ORDER BY nama_rencana ASC");
$getrencanaF = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 6 ORDER BY nama_rencana ASC");

$nama_halaman = 'Map tematik';
$linkcss = 'tematik.css';
require 'views/mapTematik.view.php';
