<?php include 'partials/starter-head.php' ?>
<?php include 'functions/sweetalert.php' ?>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>
<style>
    .swal2-icon {
        margin: auto !important;
    }

    .swal2-x-mark {
        color: red !important;
    }

    .swal2-popup {
        /* background: url(../assets/index/footer2.jpg ) !important; */
        background-color: #333333 !important;
        padding: 20px !important;
        box-shadow: 0 0 7px #333333 !important;
        border-radius: 13px !important;
    }

    .swal2-title {
        color: orange !important;
        margin-top: 15px !important;
        margin-bottom: 15px !important;
    }

    .swal2-html-container {
        color: white !important;
        margin-bottom: 15px !important;
    }

    .swal2-cancel {
        padding: 5px 8px !important;
        margin-left: 5px !important;
        background-color: red !important;
    }

    .swal2-confirm {
        padding: 5px 8px !important;
        margin-right: 5px !important;
        background-color: green !important;
    }

    @media screen and (max-width:990px) {
        .search-class {
            width: 65% !important;
        }
    }

    .table-res {
        overflow-y: auto !important;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col">
            <!-- Search -->
            <div class="input-group search-class mb-5 mt-5 w-25">
                <input type="search" id="search" class="form-control input-search" placeholder="Cari disini" aria-label="Cari disini" aria-describedby="button-addon2">
                <button class="btn btn-search btn-outline-secondary" type="button" id="cari"><i class="bi bi-search"></i></button>
            </div>
            <!-- Table -->
            <div class="table-res">
                <table class="table table-striped table-hover mb-5">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">File</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                        <!-- Data will be loaded here using AJAX -->
                    </tbody>
                </table>
            </div>
            <!-- PAGINATION -->
            <nav aria-label="Page navigation example mt-5">
                <ul class="pagination" id="pagination">
                    <!-- Pagination links will be added here using AJAX -->
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
        // Load initial data on page load
        loadTableData(1);

        // Handle page change
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            var page = $(this).data('page');
            loadTableData(page);
        });

        // Handle live searching
        $('#search').keyup(function() {
            loadTableData(1); // Load first page of search results
        });
    });

    function loadTableData(page) {
        var searchQuery = $('#search').val();

        $.ajax({
            url: 'ajax/publikasi-data.php', // Change this to your PHP file
            method: 'POST',
            data: {
                page: page,
                search: searchQuery
            },
            dataType: 'json',
            success: function(data) {
                $('#table-data').html(data.tableData);
                $('#pagination').html(data.pagination);
            }
        });
    }

    var table = document.querySelector('.table');

    table.addEventListener('click', function(event) {
        if (event.target.classList.contains('download-link')) {
            event.preventDefault();

            var url = event.target.href;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: data.error,
                            timer: 5000,
                            showConfirmButton: false
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });
</script>
<?php include 'partials/starter-foot.php' ?>