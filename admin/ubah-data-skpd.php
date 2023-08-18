<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM skpd");

$i = 1;

$nama_halaman = 'Update SKPD';
$linkcss = 'ubah-skpd.css';
require 'views/ubah-skpd.view.php';
