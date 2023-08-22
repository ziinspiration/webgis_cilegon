<?php
require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM status_kemantapan WHERE nama_data = 'kemantapan_drainase'");

$nama_halaman = 'Kemantapan Drainase';
$folder = 'INFRASTRUKTUR';
$name_page = 'Kemantapan Drainase';
require 'views/kDrainase.view.php';
