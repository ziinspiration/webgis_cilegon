<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login");
    exit;
}

require '../functions/functions.php';

$conn = koneksi();

$informasi = $_POST['informasi'];
$id = $_POST['id'];
$type = $_POST['type'];

$table = "";
switch ($type) {
    case "facebook":
    case "instagram":
    case "twitter":
    case "youtube":
        $table = "informasi_bappeda";
        break;
}

$query = "UPDATE $table SET informasi = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "si", $informasi, $id);

if (mysqli_stmt_execute($stmt)) {
    // Berhasil melakukan update data
    echo json_encode(["success" => true]);
} else {
    // Gagal melakukan update data
    echo json_encode(["success" => false, "message" => "Gagal mengupdate data"]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
