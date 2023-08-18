<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data kemantapan jalan';
$linkcss = 'data-kJalan.css';
require 'views/data-kJalan.view.php';
