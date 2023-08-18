<?php
require_once '../functions/functions.php';

$page = isset($_POST['page']) ? $_POST['page'] : 1;
$itemsPerPage = 5;
$start = ($page - 1) * $itemsPerPage;

$searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

$query = "SELECT * FROM publikasi"; // Ganti "publikasi" dengan nama tabel yang sesuai
if (!empty($searchQuery)) {
    $query .= " WHERE nama_data LIKE '%$searchQuery%' OR keterangan LIKE '%$searchQuery%'";
}
$query .= " ORDER BY nama_data ASC LIMIT $start, $itemsPerPage";

$getdata = query($query);

$output = '';
$i = $start + 1; // Initialize counter for row number
foreach ($getdata as $a) {
    $output .= '<tr>
                    <td><a href="download.pdf.php?id=' . $a['id'] . '" class="download-link">' . $a['nama_data'] . '</a></td>
                    <td>' . $a['keterangan'] . '</td>
                </tr>';
}

$totalItems = count(query("SELECT * FROM publikasi")); // Ganti "publikasi" dengan nama tabel yang sesuai
$totalPages = ceil($totalItems / $itemsPerPage);

$pagination = '';
for ($i = 1; $i <= $totalPages; $i++) {
    $activeClass = ($i == $page) ? 'active' : '';
    $pagination .= '<li class="page-item ' . $activeClass . '">
                        <a class="page-link ' . ($activeClass ? 'bg-secondary text-orange' : 'orange') . '" href="#" data-page="' . $i . '">' . $i . '</a>
                    </li>';
}

// Check if there are no search results
if (empty($getdata)) {
    $output .= '<tr><td colspan="3"><div class="m-auto text-center p-3">Tidak ada data yang cocok dengan kriteria pencarian anda.</div></td></tr>';
}

echo json_encode(array(
    'tableData' => $output,
    'pagination' => $pagination
));
