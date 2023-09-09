<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login");
    exit;
}

require '../functions/functions.php';

$conn = koneksi();

if (isset($_POST['informasi']) && isset($_POST['nama_data'])) {
    $informasi = $_POST['informasi'];
    $namaData = $_POST['nama_data'];

    // Jenis informasi secara default diatur sebagai "marquee"
    $jenis_informasi = "marquee";

    $table = "informasi_bappeda";
    $query = "INSERT INTO $table (nama_data, informasi, jenis_informasi) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $namaData, $informasi, $jenis_informasi);

    if (mysqli_stmt_execute($stmt)) {
        // Berhasil menyimpan data baru
        echo json_encode(["success" => true]);
    } else {
        // Gagal menyimpan data baru
        echo json_encode(["success" => false, "message" => "Gagal menyimpan data baru"]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    error_log("Informasi: " . $informasi);
    error_log("Nama Data: " . $namaData);
}
