<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Informasi website';
$linkcss = 'informasi-web.css';
require 'views/informasi-web.view.php';
