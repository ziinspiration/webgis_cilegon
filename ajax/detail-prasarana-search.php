<?php
require_once '../functions/functions.php';

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = 8;
$start = ($page - 1) * $itemsPerPage;

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';
$id = isset($_POST['data_pokok_id']) ? $_POST['data_pokok_id'] : '';

$query = "SELECT * FROM atribut_prasarana 
JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id";

if (!empty($id)) {
    $query .= " WHERE atribut_prasarana.data_pokok_id = $id";
}

if (!empty($searchQuery)) {
    $query .= " AND (nama LIKE '%$searchQuery%' OR keterangan LIKE '%$searchQuery%' OR x LIKE '%$searchQuery%' OR y LIKE '%$searchQuery%')";
}

$totalItems = count(query($query)); // Hitung total item sesuai kondisi

$query .= " ORDER BY nama ASC LIMIT $start, $itemsPerPage";

$getdata = query($query);

$output = '';
$i = $start + 1;

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

$totalPages = ceil($totalItems / $itemsPerPage);

$pagination = '';
$prevPage = ($page > 1) ? $page - 1 : 1;
$nextPage = ($page < $totalPages) ? $page + 1 : $totalPages;

$pagination .= '<li class="page-item rounded-circle"><a class="page-link text-dark rounded-start-pill rounded-circle bg-body-tertiary" href="#" data-page="1"><i class="fa-solid fa-angle-double-left"></i></a></li>';
$pagination .= '<li class="page-item rounded-circle"><a class="page-link text-dark rounded-end-pill rounded-circle me-1 bg-body-tertiary" href="#" data-page="' . $prevPage . '"><i class="fa-solid fa-angle-left"></i></i></a></li>';

$startPage = max(1, $page - 2);
$endPage = min($startPage + 2, $totalPages);

if ($startPage > 1) {
    $pagination .= '<li class="page-item disabled"><span class="page-link bg-transparent border-0">...</span></li>';
}

for ($i = $startPage; $i <= $endPage; $i++) {
    $activeClass = ($i == $page) ? 'active' : '';
    $pagination .= '<li class="page-item' . $activeClass . '">
                        <a class="page-link ' . ($activeClass ? 'bg-secondary-subtle border border-secondary-subtle fw-bolder text-dark rounded-circle ms-1' : 'bg-body-tertiary text-dark rounded-3 ms-1') . '" href="#" data-page="' . $i . '">' . $i . '</a>
                    </li>';
}

if ($endPage < $totalPages) {
    $pagination .= '<li class="page-item disabled"><span class="page-link bg-transparent border-0">...</span></li>';
}


$pagination .= '<li class="page-item"><a class="page-link text-dark rounded-start-pill ms-1 bg-body-tertiary" href="#" data-page="' . $nextPage . '"><i class="fa-solid fa-angle-right"></i></i></a></li>';
$pagination .= '<li class="page-item"><a class="page-link bg-body-tertiary fw-bolder text-dark rounded-end-pill" href="#" data-page="' . $totalPages . '"><i class="fa-solid fa-angles-right"></i></a></li>';

echo json_encode(array(
    'tableData' => $output,
    'pagination' => $pagination
));
