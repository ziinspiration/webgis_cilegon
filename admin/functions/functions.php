<?php
if (!function_exists('koneksi')) {
    function koneksi()
    {
        $conn = mysqli_connect("localhost", "root", "", "webgis-cilegon");
        return $conn;
    }
}

if (!function_exists('query')) {
    function query($sql)
    {
        $conn = koneksi();
        $result = mysqli_query($conn, "$sql");
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}

// REGISTRASI
function registrasi($data)
{
    $conn = koneksi();

    $nik = strtolower(stripslashes($data["nik"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $nama_admin = mysqli_real_escape_string($conn, $data["nama_pegawai"]);

    // cek nik sudah ada atau belum 
    $result = mysqli_query($conn, "SELECT nik FROM admin WHERE nik = '$nik'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Admin sudah terdaftar')
              </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('konfirmasi password tidak sesuai)
              </script>";
        return false;
    }

    // enkripsi password 
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO admin VALUES(null,'$nama_admin','$nik', '$password')");

    return mysqli_affected_rows($conn);
}
