<?php
require_once 'functions/functions.php';

// $getTematik = query("SELECT * FROM tematik ORDER BY nama_tematik ASC");
$getrencanaA = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 1 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaB = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 2 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaC = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 3 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaD = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 4 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaE = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 5 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaF = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 6 AND hide = 1 ORDER BY nama_rencana ASC");

$getlegenda = query("SELECT * FROM rencana WHERE id_jenis_file = 1");

$nama_halaman = 'Rencana';
$linkcss = 'tematik.css';
require 'views/rencana.view.php';
