<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$nama_halaman = 'Registrasi admin';
$linkcss = 'register-admin.css';
require 'views/register-admin.view.php';
