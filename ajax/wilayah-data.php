<?php
require_once '../functions/functions.php';

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = 5;
$start = ($page - 1) * $itemsPerPage;

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

$query = "SELECT * FROM wilayah";
if (!empty($searchQuery)) {
    $query .= " WHERE kecamatan LIKE '%$searchQuery%' OR ibukota LIKE '%$searchQuery%'";
}
$query .= " ORDER BY kecamatan ASC LIMIT $start, $itemsPerPage";

$getdata = query($query);

$output = '';
$i = $start + 1; // Initialize counter for row number

if (count($getdata) > 0) {
    foreach ($getdata as $a) {
        $output .= '<tr>
                        <th scope="row">' . $i++ . '</th>
                        <td>' . $a['kecamatan'] . '</td>
                        <td>' . $a['ibukota'] . '</td>
                    </tr>';
    }
} else {
    $output = '<tr><td colspan="3"><div class="m-auto text-center p-3">Tidak ada data yang cocok dengan kriteria pencarian anda.</div></td></tr>';
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
