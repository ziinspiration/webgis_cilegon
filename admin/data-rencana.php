<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data rencana';
$linkcss = 'data-rencana.css';
require 'views/data-rencana.view.php';
