<?php
require_once '../functions/functions.php';

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = 5;
$start = ($page - 1) * $itemsPerPage;

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

$query = "SELECT * FROM wilayah";
if (!empty($searchQuery)) {
    $query .= " WHERE kode_wilayah LIKE '%$searchQuery%' OR  kecamatan LIKE '%$searchQuery%' OR jumlah_kelurahan LIKE '%$searchQuery%' OR daftar_kelurahan LIKE '%$searchQuery%'";
}
$query .= " ORDER BY kecamatan ASC LIMIT $start, $itemsPerPage";

$getdata = query($query);

$output = '';
$i = $start + 1; // Initialize counter for row number

if (count($getdata) > 0) {
    foreach ($getdata as $a) {
        $output .= '<tr>
                        <th scope="row">' . $a['kode_wilayah'] . '</th>
                        <td>' . $a['kecamatan'] . '</td>
                        <td>' . $a['jumlah_kelurahan'] . '</td>
                        <td>' . $a['daftar_kelurahan'] . '</td>
                    </tr>';
    }
} else {
    $output = '<tr><td colspan="4"><div class="m-auto text-center p-3">Data tidak tersedia.</div></td></tr>';
}

$totalItems = count(query("SELECT * FROM wilayah"));
$totalPages = ceil($totalItems / $itemsPerPage);

$pagination = '';
for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($i == $page) ? 'active' : '';
    $pagination .= '<li class="page-item ' . $activeClass . '">
                        <a class="page-link ' . ($activeClass ? 'bg-secondary orange' : 'orange') . '" href="#" data-page="' . $i . '">' . $i . '</a>
                    </li>';
}

echo json_encode(array(
    'tableData' => $output,
    'pagination' => $pagination
));
