<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM rencana");

$i = 0;

$nama_halaman = 'Update rencana';
$linkcss = 'ubah-rencana.css';
require 'views/ubah-rencana.view.php';
