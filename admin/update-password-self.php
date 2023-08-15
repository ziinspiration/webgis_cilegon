<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login");
    exit;
}

require 'functions/functions.php';

$conn = koneksi();

$admin_id = $_SESSION["id"];

// if (isset($_POST["update"])) {
//     $current_password = $_POST["current_password"];
//     $new_password = $_POST["new_password"];
//     $confirm_password = $_POST["confirm_password"];

//     // Ambil password lama dari database
//     $query = "SELECT password FROM admin WHERE id = $admin_id";
//     $result = mysqli_query($conn, $query);
//     $admin = mysqli_fetch_assoc($result);

//     // Periksa apakah password lama cocok
//     if (password_verify($current_password, $admin["password"])) {
//         // Periksa apakah konfirmasi password baru sesuai
//         if ($new_password === $confirm_password) {
//             // Hash password baru sebelum menyimpan ke database
//             $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

//             // Update password baru ke dalam database
//             $update_query = "UPDATE admin SET password = '$hashed_password' WHERE id = $admin_id";
//             mysqli_query($conn, $update_query);

//             // Menampilkan SweetAlert berhasil
//             echo '<script>
//                 swal("Sukses", "Kata sandi berhasil diperbarui.", "success");
//             </script>';
//         } else {
//             // Menampilkan SweetAlert konfirmasi password tidak sesuai
//             echo '<script>
//                 swal("Error", "Konfirmasi kata sandi tidak sesuai.", "error");
//             </script>';
//         }
//     } else {
//         // Menampilkan SweetAlert password lama tidak sesuai
//         echo '<script>
//             swal("Error", "Kata sandi lama tidak sesuai.", "error");
//         </script>';
//     }
// }

$nama_halaman = 'Update password';
$linkcss = 'update-password.css';
require 'views/update-password-self.view.php';
