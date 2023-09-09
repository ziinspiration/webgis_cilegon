<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data prasarana';
$linkcss = 'data-prasarana.css';
require 'views/data-prasarana.view.php';
