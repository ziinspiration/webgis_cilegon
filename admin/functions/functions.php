<?php
include_once 'sweetalert.php';

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

// Hitung data publikasi
function countPublikasi()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM publikasi";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}

// Hitung data wilayah
function countWilayah()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM wilayah";
    $result = query($query);

    // Periksa hasil query
    if ($result && isset($result[0]['total'])) {
        return $result[0]['total'];
    } else {
        return 0;
    }
}

// Hitung data skpd
function countSKPD()
{
    $conn = koneksi();

    $query = "SELECT COUNT(*) AS total FROM skpd";
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

// Hapus data publikasi
function deletePublikasi($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM publikasi WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Hapus data wilayah
function deleteWilayah($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM wilayah WHERE id = $id");

    return mysqli_affected_rows($conn);
}

// Hapus data skpd
function deleteSKPD($id)
{
    $conn = koneksi();
    mysqli_query($conn, "DELETE FROM skpd WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function deleteAtributAdministrasi($id)
{
    $conn = koneksi();
    $stmt = mysqli_prepare($conn, "DELETE FROM atribut_administrasi WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $affected_rows;
}

function deleteAtributTematik($id)
{
    $conn = koneksi();
    $stmt = mysqli_prepare($conn, "DELETE FROM atribut_tematik WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $affected_rows;
}

function deleteAtributRencana($id)
{
    $conn = koneksi();
    $stmt = mysqli_prepare($conn, "DELETE FROM atribut_rencana WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $affected_rows;
}

function deleteAtributSarana($id)
{
    $conn = koneksi();
    $stmt = mysqli_prepare($conn, "DELETE FROM atribut_sarana WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $affected_rows;
}

function deleteAtributPrasarana($id)
{
    $conn = koneksi();
    $stmt = mysqli_prepare($conn, "DELETE FROM atribut_Prasarana WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $affected_rows = mysqli_stmt_affected_rows($stmt);

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $affected_rows;
}

function deletePokokAdministrasi($id)
{
    $conn = koneksi();

    // Hapus data terkait dari tabel atribut_administrasi
    $stmt_delete_atribut = mysqli_prepare($conn, "DELETE FROM atribut_administrasi WHERE data_pokok_id = ?");
    mysqli_stmt_bind_param($stmt_delete_atribut, "i", $id);
    mysqli_stmt_execute($stmt_delete_atribut);
    mysqli_stmt_close($stmt_delete_atribut);

    // Hapus data dari tabel data_administrasi
    $stmt_delete_data = mysqli_prepare($conn, "DELETE FROM data_administrasi WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete_data, "i", $id);
    mysqli_stmt_execute($stmt_delete_data);

    $affected_rows = mysqli_stmt_affected_rows($stmt_delete_data);

    mysqli_stmt_close($stmt_delete_data);
    mysqli_close($conn);

    return $affected_rows;
}

function deletePokokTematik($id)
{
    $conn = koneksi();

    // Hapus data terkait dari tabel atribut_tematik
    $stmt_delete_atribut = mysqli_prepare($conn, "DELETE FROM atribut_tematik WHERE data_pokok_id = ?");
    mysqli_stmt_bind_param($stmt_delete_atribut, "i", $id);
    mysqli_stmt_execute($stmt_delete_atribut);
    mysqli_stmt_close($stmt_delete_atribut);

    // Hapus data dari tabel data_tematik
    $stmt_delete_data = mysqli_prepare($conn, "DELETE FROM data_tematik WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete_data, "i", $id);
    mysqli_stmt_execute($stmt_delete_data);

    $affected_rows = mysqli_stmt_affected_rows($stmt_delete_data);

    mysqli_stmt_close($stmt_delete_data);
    mysqli_close($conn);

    return $affected_rows;
}

function deletePokokRencana($id)
{
    $conn = koneksi();

    // Hapus data terkait dari tabel atribut_rencana
    $stmt_delete_atribut = mysqli_prepare($conn, "DELETE FROM atribut_rencana WHERE data_pokok_id = ?");
    mysqli_stmt_bind_param($stmt_delete_atribut, "i", $id);
    mysqli_stmt_execute($stmt_delete_atribut);
    mysqli_stmt_close($stmt_delete_atribut);

    // Hapus data dari tabel data_rencana
    $stmt_delete_data = mysqli_prepare($conn, "DELETE FROM data_rencana WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete_data, "i", $id);
    mysqli_stmt_execute($stmt_delete_data);

    $affected_rows = mysqli_stmt_affected_rows($stmt_delete_data);

    mysqli_stmt_close($stmt_delete_data);
    mysqli_close($conn);

    return $affected_rows;
}

function deletePokokSarana($id)
{
    $conn = koneksi();

    // Hapus data terkait dari tabel atribut_sarana
    $stmt_delete_atribut = mysqli_prepare($conn, "DELETE FROM atribut_sarana WHERE data_pokok_id = ?");
    mysqli_stmt_bind_param($stmt_delete_atribut, "i", $id);
    mysqli_stmt_execute($stmt_delete_atribut);
    mysqli_stmt_close($stmt_delete_atribut);

    // Hapus data dari tabel data_sarana
    $stmt_delete_data = mysqli_prepare($conn, "DELETE FROM data_sarana WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete_data, "i", $id);
    mysqli_stmt_execute($stmt_delete_data);

    $affected_rows = mysqli_stmt_affected_rows($stmt_delete_data);

    mysqli_stmt_close($stmt_delete_data);
    mysqli_close($conn);

    return $affected_rows;
}

function deletePokokPrasarana($id)
{
    $conn = koneksi();

    // Hapus data terkait dari tabel atribut_prasarana
    $stmt_delete_atribut = mysqli_prepare($conn, "DELETE FROM atribut_prasarana WHERE data_pokok_id = ?");
    mysqli_stmt_bind_param($stmt_delete_atribut, "i", $id);
    mysqli_stmt_execute($stmt_delete_atribut);
    mysqli_stmt_close($stmt_delete_atribut);

    // Hapus data dari tabel data_prasarana
    $stmt_delete_data = mysqli_prepare($conn, "DELETE FROM data_prasarana WHERE id = ?");
    mysqli_stmt_bind_param($stmt_delete_data, "i", $id);
    mysqli_stmt_execute($stmt_delete_data);

    $affected_rows = mysqli_stmt_affected_rows($stmt_delete_data);

    mysqli_stmt_close($stmt_delete_data);
    mysqli_close($conn);

    return $affected_rows;
}
