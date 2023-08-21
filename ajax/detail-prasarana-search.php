<?php
require_once '../functions/functions.php';

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = 5;
$start = ($page - 1) * $itemsPerPage;

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';
$id = isset($_POST['data_pokok_id']) ? $_POST['data_pokok_id'] : ''; // Pastikan Anda mengambil nilai ini dari permintaan AJAX

$query = "SELECT * FROM atribut_prasarana 
JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id";

if (!empty($id)) {
    $query .= " WHERE atribut_prasarana.data_pokok_id = $id";
}

if (!empty($searchQuery)) {
    $query .= " AND (nama LIKE '%$searchQuery%' OR keterangan LIKE '%$searchQuery%' OR x LIKE '%$searchQuery%' OR y LIKE '%$searchQuery%')";
}

$query .= " ORDER BY nama ASC LIMIT $start, $itemsPerPage";

$getdata = query($query);

$output = '';
$i = $start + 1; // Inisialisasi hitungan untuk nomor baris

if (count($getdata) > 0) {
    foreach ($getdata as $a) {
        $output .= '<tr>
        <th>' . $i++ . '</th>
        <td>' . $a['nama'] . '</td>
        <td>' . $a['keterangan'] . '</td>
        <td>' . $a['x'] . '</td>
        <td>' . $a['y'] . '</td>  
                    </tr>';
    }
} else {
    $output = '<tr><td colspan="6"><div class="m-auto text-center p-3">Data tidak tersedia</div></td></tr>';
}

$totalItems = count(query("SELECT * FROM atribut_prasarana 
JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id"));

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
