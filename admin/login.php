<?php
session_start();

require 'functions/functions.php';

if (isset($_SESSION["login"])) {
    header("location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $nik = $_POST["nik"];
    $password = $_POST["password"];
    $conn = koneksi();

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE nik = '$nik'");

    // CEK USERNAME
    if (mysqli_num_rows($result) === 1) {
        // CEK PASSWORD
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];

            // set cookie
            setcookie("nik", $nik, time() + 3600);

            header("location: index.php");
            exit;
        }
    }

    $_SESSION['error'] = true;
}


$nama_halaman = 'Login admin';
$linkcss = 'login.css';
require 'views/login.view.php';
