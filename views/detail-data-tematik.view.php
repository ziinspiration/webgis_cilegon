<?php include 'partials/starter-head.php' ?>
<style>
.table-res {
    overflow-y: auto !important;
}

@media screen and (max-width:990px) {
    .search-class {
        width: 65% !important;
    }
}
</style>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Search -->
            <div class="input-group search-class mb-5 mt-5 w-25">
                <input type="search" id="search" class="form-control input-search" placeholder="Cari disini"
                    aria-label="Cari disini" aria-describedby="button-addon2">
                <button class="btn btn-search btn-outline-secondary" type="button" id="cari"><i
                        class="bi bi-search"></i></button>
            </div>
            <!-- Table -->
            <div class="table-res">
                <table class="table table-striped table-hover mb-5 table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Kelurahan</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Fungsi</th>
                            <th scope="col">Sumber</th>
                            <th scope="col">Luas</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                    </tbody>
                </table>
                <!-- PAGINATION -->
            </div>
            <nav aria-label="Page navigation example mt-5">
                <ul class="pagination" id="pagination">
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Memuat data awal saat halaman dimuat
    loadTableData(1);

    // Menangani perubahan halaman
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).data('page');
        loadTableData(page);
    });

    // Menangani pencarian langsung
    $('#search').keyup(function() {
        loadTableData(1); // Memuat halaman pertama hasil pencarian
    });
});

function loadTableData(page) {
    var searchQuery = $('#search').val();

    $.ajax({
        url: 'assets/ajax/detail-tematik-search.php',
        method: 'POST',
        data: {
            page: page,
            search: searchQuery,
            data_pokok_id: <?php echo $id; ?> // Pastikan variabel $id sudah didefinisikan sebelumnya
        },
        dataType: 'json', // Menentukan tipe data yang diharapkan
        success: function(data) {
            $('#table-data').html(data.tableData);
            $('#pagination').html(data.pagination);
        }
    });
}
</script>
<?php include 'partials/starter-foot.php' ?>