<?php
session_start();

require 'functions/functions.php';

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

$conn = koneksi();

$nama_halaman = 'Registrasi admin';
$linkcss = 'register-admin.css';
require 'views/register-admin.view.php';
