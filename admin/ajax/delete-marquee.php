<?php
// delete-data.php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login.php");
    exit;
}

require '../functions/functions.php';

$conn = koneksi();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];

    $table = "informasi_bappeda";

    $query = "DELETE FROM $table WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        // Penghapusan data berhasil
        echo json_encode(["success" => true]);
    } else {
        // Gagal menghapus data
        echo json_encode(["success" => false, "message" => "Gagal menghapus data"]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
