<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data tematik';
$linkcss = 'data-tematik.css';
require 'views/data-tematik.view.php';
