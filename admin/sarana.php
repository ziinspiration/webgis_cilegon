<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Sarana';
$linkcss = 'sarana.css';
require 'views/sarana.view.php';
