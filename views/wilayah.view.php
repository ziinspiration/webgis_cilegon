<?php include 'partials/starter-head.php' ?>
<style>
    @media screen and (max-width:990px) {
        .search-class {
            width: 65% !important;
        }

        .table-res {
            overflow-y: auto !important;
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
                <input type="search" id="search" class="form-control input-search" placeholder="Cari disini" aria-label="Cari disini" aria-describedby="button-addon2">
                <button class="btn btn-search btn-outline-secondary" type="button" id="cari"><i class="bi bi-search"></i></button>
            </div>
            <!-- Table -->
            <div id="loading-spinner">
                <img class="load-animation" src="assets/index/loading-animation.gif" alt="">
                <h5 class="text-center text-loading">Sedang memuat...</h5>
            </div>
            <div class="table-res">
                <table class="table table-striped table-hover mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Kode wilayah</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Jumlah kelurahan</th>
                            <th scope="col">Daftar kelurahan</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                    </tbody>
                </table>
            </div>
            <!-- PAGINATION -->
            <nav aria-label="Page navigation example mt-5">
                <ul class="pagination" id="pagination">
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<?php include 'partials/starter-foot.php' ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        loadTableData(1);

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            loadTableData(page);
        });

        $('#search').keyup(function() {
            loadTableData(1);
        });
    });

    function loadTableData(page) {
        var searchQuery = $('#search').val();
        $('#loading-spinner').show();

        $.ajax({
            url: 'assets/ajax/wilayah-data.php',
            method: 'POST',
            data: {
                page: page,
                search: searchQuery
            },
            dataType: 'json',
            success: function(data) {
                $('#table-data').html(data.tableData);
                $('#pagination').html(data.pagination);
                $('#loading-spinner').hide();
            }
        });
    }
</script>