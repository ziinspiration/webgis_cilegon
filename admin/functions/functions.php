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

// Fungsi untuk menghindari potensi serangan XSS (Cross-Site Scripting)
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require_once 'get-information.php';

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


// Hitung data administrasi
function countAdministrasi()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM administrasi";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}

// Hitung data prasarana
function countPrasarana()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM prasarana";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}

// Hitung data sarana
function countSarana()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM sarana";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}


// Hitung data admin
function countAkun()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM admin";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}

// Hitung data rencana
function countRencana()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM rencana";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}

// Hitung data tematik
function countTematik()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM tematik";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}

// Hapus data administrasi
function deleteAdministrasi($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM administrasi WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Hapus data prasarana
function deletePrasarana($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM prasarana WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Hapus data sarana
function deleteSarana($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM sarana WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Hapus data admin
function deleteAkun($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM admin WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Hapus data rencana
function deleteRencana($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM rencana WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Hapus data tematik
function deleteTematik($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM tematik WHERE id = $id");

    return mysqli_affected_rows($conn);
}
