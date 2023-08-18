<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data kemantapan drainase';
$linkcss = 'data-kDrainase.css';
require 'views/data-kDrainase.view.php';
