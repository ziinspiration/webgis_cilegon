<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update prasarana';
$linkcss = 'ubah-prasarana.css';
require 'views/ubah-prasarana.view.php';
