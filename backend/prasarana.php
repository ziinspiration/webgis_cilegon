<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Prasarana';
$linkcss = 'prasarana.css';
require 'views/prasarana.view.php';
