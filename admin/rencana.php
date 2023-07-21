<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Rencana';
$linkcss = 'rencana.css';
require 'views/rencana.view.php';
