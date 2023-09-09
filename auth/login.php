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

    // CEK NIK
    if (mysqli_num_rows($result) === 1) {
        // CEK PASSWORD
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];

            $nama = $row["nama_pegawai"];
            setcookie("nama_pegawai", $nama, time() + 3600);

            // Periksa rolenya apakah "master" atau "non-master"
            $role = $row["role"];
            setcookie("role_admin", $role, time() + 3600);

            // Periksa apakah rolenya adalah "master", jika ya, arahkan ke halaman admin-setting.php
            if ($role === "master") {
                header("location: ../backend/admin-setting");
            } else {
                header("location: ../backend/index");
            }
            exit;
        }
    }

    $_SESSION['error'] = true;

    // Tambahkan penghitungan percobaan login yang gagal
    if (!isset($_SESSION['failed_login_count'])) {
        $_SESSION['failed_login_count'] = 1;
    } else {
        $_SESSION['failed_login_count']++;
    }

    // Cek jika jumlah percobaan login yang gagal mencapai batas
    if ($_SESSION['failed_login_count'] >= 5) {
        $_SESSION['lockout_time'] = time() + 300; // Lockout for 5 minutes (300 seconds)
        $_SESSION['failed_login_count'] = 0; // Reset failed login count
    }
}

$nama_halaman = 'Login admin';
$linkcss = 'login.css';
require 'views/login.view.php';
