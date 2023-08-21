<?php
require_once '../functions/functions.php';

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = 5;
$start = ($page - 1) * $itemsPerPage;

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';
$id = isset($_POST['data_pokok_id']) ? $_POST['data_pokok_id'] : '';

$query = "SELECT * FROM atribut_rencana 
JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id";

if (!empty($id)) {
    $query .= " WHERE atribut_rencana.data_pokok_id = $id";
}

if (!empty($searchQuery)) {
    $query .= " AND (kecamatan LIKE '%$searchQuery%' OR kelurahan LIKE '%$searchQuery%' OR keterangan LIKE '%$searchQuery%' OR sumber LIKE '%$searchQuery%'  OR luas LIKE '%$searchQuery%')";
}

$query .= " ORDER BY kecamatan ASC LIMIT $start, $itemsPerPage";

$getdata = query($query);

$output = '';
$i = $start + 1; // Inisialisasi hitungan untuk nomor baris

if (count($getdata) > 0) {
    foreach ($getdata as $a) {
        $output .= '<tr>
                        <th>' . $i++ . '</th>
                        <td>' . $a['kecamatan'] . '</td>
                        <td>' . $a['kelurahan'] . '</td>
                        <td>' . $a['keterangan'] . '</td>
                        <td>' . $a['sumber'] . '</td>    
                        <td>' . $a['luas'] . '</td>            
                    </tr>';
    }
} else {
    $output = '<tr><td colspan="6"><div class="m-auto text-center p-3">Data tidak tersedia</div></td></tr>';
}

$totalItems = count(query("SELECT * FROM atribut_rencana 
JOIN data_rencana ON atribut_rencana.data_pokok_id = data_rencana.id"));

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
