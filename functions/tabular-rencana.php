<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama_data = $_POST["nama_data"];

    $_SESSION["id"] = $id;
    $_SESSION["nama_data"] = $nama_data;

    header("Location: ../detail-data-rencana");
    exit;
}
