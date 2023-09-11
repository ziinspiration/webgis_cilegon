<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: ../login");
    exit;
}

require '../functions/functions.php';

$conn = koneksi();

$admin_id = $_SESSION["id"];

$query = "SELECT * FROM admin WHERE id = $admin_id";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

$nik = $_POST['nik'];
$nama_pegawai = $_POST['nama_pegawai'];

$checkQuery = "SELECT * FROM admin WHERE nik = '$nik' AND id != $admin_id";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    mysqli_close($conn);
    echo '<script>alert("NIK sudah digunakan oleh admin lain. Perubahan tidak dapat dilakukan."); window.location.href = "../daftar-akun.php";</script>';
    exit;
}

$new_foto_profile = $admin['foto_profile'];

if (isset($_FILES['new_foto_profile']) && $_FILES['new_foto_profile']['error'] === UPLOAD_ERR_OK) {
    $foto_profile = $_FILES['new_foto_profile']['tmp_name'];

    $file_info = pathinfo($_FILES['new_foto_profile']['name']);
    $file_extension = strtolower($file_info['extension']);
    $allowed_extensions = array('jpg', 'jpeg', 'png');

    if (in_array($file_extension, $allowed_extensions)) {
        $imagePath = '../../assets/profile_picture/' . $admin_id . '.' . $file_extension;
        move_uploaded_file($foto_profile, $imagePath);
        $new_foto_profile = $admin_id . '.' . $file_extension;
    } else {
        echo '<script>alert("Jenis file yang diunggah tidak diperbolehkan."); window.location.href = "../daftar-akun.php";</script>';
        exit;
    }
}

$query = "UPDATE admin SET nik = '$nik', nama_pegawai = '$nama_pegawai', foto_profile = '$new_foto_profile' WHERE id = $admin_id";
mysqli_query($conn, $query);

mysqli_close($conn);
