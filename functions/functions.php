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
