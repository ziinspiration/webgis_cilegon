<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

if (isset($_POST["kirim_marque"])) {

    $nama_data = $_POST["nama_data"];
    $informasi = $_POST["informasi"];
    $jenis_informasi = $_POST["jenis_informasi"];

    // Insert the data into the "informasi_bappeda" table
    $query = "INSERT INTO informasi_bappeda (nama_data, informasi, jenis_informasi) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $nama_data, $informasi, $jenis_informasi);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: medsos-control.php");
        exit;
    } else {
        header("Location: medsos-control.php");
        exit;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

$nama_halaman = 'Media sosial control';
$linkcss = 'medsos-control.css';
require 'views/medsos-control.view.php';
