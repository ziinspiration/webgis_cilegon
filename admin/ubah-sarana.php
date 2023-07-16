<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Update sarana';
$linkcss = 'ubah-sarana.css';
require 'views/ubah-sarana.view.php';
