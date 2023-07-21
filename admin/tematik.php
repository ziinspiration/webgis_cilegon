<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Tematik';
$linkcss = 'tematik.css';
require 'views/tematik.view.php';
