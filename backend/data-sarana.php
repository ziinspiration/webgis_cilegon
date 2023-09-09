<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Data sarana';
$linkcss = 'data-sarana.css';
require 'views/data-sarana.view.php';
