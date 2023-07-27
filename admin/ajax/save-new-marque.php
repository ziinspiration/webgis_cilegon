<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login.php");
    exit;
}

require '../functions/functions.php';

$conn = koneksi();

if (isset($_POST['informasi']) && isset($_POST['new_nama_data'])) {
    $informasi = $_POST['informasi'];
    $namaData = $_POST['new_nama_data'];

    $table = "informasi_bappeda";
    $query = "INSERT INTO $table (nama_data, informasi) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $namaData, $informasi);

    if (mysqli_stmt_execute($stmt)) {
        // Berhasil menyimpan data baru
        echo json_encode(["success" => true]);
    } else {
        // Gagal menyimpan data baru
        echo json_encode(["success" => false, "message" => "Gagal menyimpan data baru"]);
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
