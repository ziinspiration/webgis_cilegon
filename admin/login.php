<?php
session_start();

require 'functions/functions.php';

if (isset($_SESSION["login"])) {
    header("location: index");
    exit;
}

if (isset($_POST["login"])) {
    $nik = $_POST["nik"];
    $password = $_POST["password"];
    $conn = koneksi();

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE nik = '$nik'");

    // CEK NIK
    if (mysqli_num_rows($result) === 1) {
        // CEK PASSWORD
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];

            // set cookie
            $nama = $row["nama_pegawai"];
            setcookie("nama_pegawai", $nama, time() + 3600);

            // Periksa rolenya apakah "master" atau "non-master"
            $role = $row["role"];
            setcookie("role_admin", $role, time() + 3600);

            // Periksa apakah rolenya adalah "master", jika ya, arahkan ke halaman admin-setting.php
            if ($role === "master") {
                header("location: admin-setting");
            } else {
                header("location: index");
            }
            exit;
        }
    }

    $_SESSION['error'] = true;
}

$nama_halaman = 'Login admin';
$linkcss = 'login.css';
require 'views/login.view.php';