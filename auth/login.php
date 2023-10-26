<?php
session_start();

require '../functions/functions.php';

if (isset($_SESSION["login"])) {
    header("location: index");
    exit;
}

if (isset($_POST["login"])) {
    $nik = $_POST["nik"];
    $password = $_POST["password"];
    $conn = koneksi();

    $result = mysqli_query($conn, "SELECT * FROM admin WHERE nik = '$nik'");


    if (mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];

            $nama = $row["nama_pegawai"];
            setcookie("nama_pegawai", $nama, time() + 3600);


            $role = $row["role"];
            setcookie("role_admin", $role, time() + 3600);


            if ($role === "master") {
                header("location: ../backend/admin-setting");
            } else {
                header("location: ../backend/index");
            }
            exit;
        }
    }

    $_SESSION['error'] = true;


    if (!isset($_SESSION['failed_login_count'])) {
        $_SESSION['failed_login_count'] = 1;
    } else {
        $_SESSION['failed_login_count']++;
    }


    if ($_SESSION['failed_login_count'] >= 5) {
        $_SESSION['lockout_time'] = time() + 300;
        $_SESSION['failed_login_count'] = 0;
    }
}

$nama_halaman = 'Login admin';
$linkcss = 'login.css';
require 'views/login.view.php';
