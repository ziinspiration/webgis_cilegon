<?php
require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM status_kemantapan WHERE nama_data = 'kemantapan_jalan'");

$nama_halaman = 'Kemantapan Jalan';
$folder = 'LAYANAN';
$name_page = 'Kemantapan Jalan';
require 'views/kJalan.view.php';
