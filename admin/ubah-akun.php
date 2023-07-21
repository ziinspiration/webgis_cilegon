<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM admin");

$i = 0;

$nama_halaman = 'Update admin';
$linkcss = 'ubah-akun.css';
require 'views/ubah-akun.view.php';
