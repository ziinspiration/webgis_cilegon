<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM status_kemantapan WHERE nama_data = 'kemantapan_jalan'");

$nama_halaman = 'Data kemantapan jalan';
$linkcss = 'data-kJalan.css';
require 'views/data-kJalan.view.php';
