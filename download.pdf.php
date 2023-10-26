<?php
require 'functions/functions.php';

$conn = koneksi();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT * FROM publikasi WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $pdf_file = 'assets/publikasi/pdf/' . $row['file_pdf'];

        if (file_exists($pdf_file)) {
            header('Content-Disposition: attachment; filename="' . basename($pdf_file) . '"');
            header('Content-Type: application/pdf');
            header('Content-Length: ' . filesize($pdf_file));
            readfile($pdf_file);
            exit;
        } else {
            echo json_encode(["error" => "File tidak ditemukan."]);
        }
    } else {
        echo json_encode(["error" => "Data tidak ditemukan."]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Permintaan tidak valid."]);
}
