<?php
require_once 'functions/functions.php';

$getrencanaA = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 1 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaB = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 2 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaC = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 3 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaD = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 4 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaE = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 5 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaF = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 6 AND hide = 1 ORDER BY nama_rencana ASC");
$getrencanaG = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 7 AND hide = 1 ORDER BY nama_rencana ASC");
$getadmin = query("SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id = 8 AND hide = 1");

// $getlegenda = query("SELECT * FROM rencana WHERE id_jenis_file = 1 AND hide = 1");
// $getlegendarencana = query("SELECT * FROM legenda WHERE jenis_id = 3");

$jenis_rencana_ids = [1, 2, 3, 4, 5, 6, 7];
$hide_value = 1; // Sesuaikan dengan nilai yang sesuai

$queryrencana = "SELECT * FROM rencana JOIN jenis_rencana ON rencana.jenis_rencana_id = jenis_rencana.id_jenis_rencana WHERE jenis_rencana_id IN (";
$queryrencana .= implode(", ", $jenis_rencana_ids);
$queryrencana .= ") AND hide = $hide_value ORDER BY nama_rencana DESC";

$getrencanaicon = query($queryrencana);

$nama_halaman = 'Rencana';
$linkcss = 'tematik.css';
require 'views/rencana.view.php';
