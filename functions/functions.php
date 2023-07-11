<?php
function connect()
{
    $conn = mysqli_connect("localhost", "root", "", "cilegon_gis");

    return $conn;
}

function query($sql)
{
    $conn = connect();
    $result = mysqli_query($conn, "$sql");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
