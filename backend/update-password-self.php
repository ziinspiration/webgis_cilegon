<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../auth/login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$admin_id = $_SESSION["id"];

$nama_halaman = 'Update password';
$linkcss = 'update-password.css';
require 'views/update-password-self.view.php';
