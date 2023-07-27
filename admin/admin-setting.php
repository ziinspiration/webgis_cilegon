<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

// Pastikan hanya admin dengan role "master" yang bisa mengakses halaman ini
if (!isset($_COOKIE["role_admin"]) || $_COOKIE["role_admin"] !== "master") {
    header("location: index.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$getdata = query("SELECT * FROM admin WHERE id <> 1");

$nama_halaman = 'Setting account';
$linkcss = 'set.css';
require 'views/setting/set-account.view.php';
