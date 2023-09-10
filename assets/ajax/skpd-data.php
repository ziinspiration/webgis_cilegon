<?php
require_once '../../functions/functions.php';

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = 10;
$start = ($page - 1) * $itemsPerPage;

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

$query = "SELECT * FROM skpd"; // Ganti "dinas" menjadi "skpd"
if (!empty($searchQuery)) {
    $query .= " WHERE nama_dinas LIKE '%$searchQuery%' OR alamat LIKE '%$searchQuery%'";
}
$query .= " ORDER BY nama_dinas ASC LIMIT $start, $itemsPerPage";

$getdata = query($query);

$output = '';
$i = $start + 1; // Initialize counter for row number

if (count($getdata) > 0) {
    foreach ($getdata as $a) {
        $output .= '<tr>
                        <th scope="row">' . $i++ . '</th>
                        <td>' . $a['nama_dinas'] . '</td>
                        <td>' . $a['alamat'] . '</td>
                    </tr>';
    }
} else {
    $output = '<tr><td colspan="3"><div class="m-auto text-center p-3">Data tidak tersedia</div></td></tr>';
}

$totalItems = count(query("SELECT * FROM skpd")); // Ganti dari "dinas" menjadi "skpd"
$totalPages = ceil($totalItems / $itemsPerPage);

$pagination = '';
for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($i == $page) ? 'active' : '';
    $pagination .= '<li class="page-item ' . $activeClass . '">
                        <a class="page-link ' . ($activeClass ? 'bg-secondary text-orange' : 'orange') . '" href="#" data-page="' . $i . '">' . $i . '</a>
                    </li>';
}

echo json_encode(array(
    'tableData' => $output,
    'pagination' => $pagination
));
