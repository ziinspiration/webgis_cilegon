<?php
include 'views/partials/starter-head.php';

if (isset($_POST['update'])) {
    $data1 = clean_input($_POST['data1']);
    $data2 = clean_input($_POST['data2']);
    $data3 = clean_input($_POST['data3']);
    $data4 = clean_input($_POST['data4']);

    // Convert the input strings to integers
    $data1 = (int) $data1;
    $data2 = (int) $data2;
    $data3 = (int) $data3;
    $data4 = (int) $data4;

    // Calculate the total
    $total = $data1 + $data2 + $data3 + $data4;

    if ($total <= 100) {
        // Prepare the query
        $query = "UPDATE status_kemantapan SET data1 = ?, data2 = ?, data3 = ?, data4 = ? WHERE nama_data = 'kemantapan_jalan'";

        // Prepare and execute the statement
        $stmt = $conn->prepare($query);
        if ($stmt) {
            // Bind the parameters with appropriate types
            $stmt->bind_param("iiii", $data1, $data2, $data3, $data4);

            if ($stmt->execute()) {
                // SweetAlert success message with redirection
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Data berhasil diupdate.",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = "data-kemantapan-jalan";
                    });
                </script>';
            } else {
                // SweetAlert error message with SQL error
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi kesalahan saat mengupdate data",
                        text: "Error: ' . $stmt->error . '"
                    });
                </script>';
            }

            $stmt->close();
        } else {
            // SweetAlert warning message for total greater than 100
            echo '<script>
                Swal.fire({
                    icon: "warning",
                    title: "Total tidak boleh melebihi 100%"
                });
            </script>';
        }
    } else {
        // SweetAlert error message for negative input values
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Input harus bernilai 0 atau lebih besar"
            });
        </script>';
    }
}
?>


<?php require_once 'views/partials/alert-tambah-data.php'; ?>
<style>
.table-res {
    overflow-y: auto !important;
}

@media screen and (max-width:990px) {
    .search-class {
        width: 65% !important;
    }
}

@media screen and (max-width:550px) {
    .input-update {
        width: 65% !important;
    }

    .chart {
        width: 80% !important;
    }
}


.table {
    font-family: Montserrat;
}

th {
    padding: 10px !important;
}

td {
    padding: 10px !important;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div>
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
        <div class="col-md-9">
            <h2 class="text-center mt-2 mb-4">Data Grafik Kemantapan Jalan</h2>
            <div class="wrapper d-flex flex-column">
                <div class="rounded m-auto mb-5 border border-secondary p-2 chart" style="width: 75%;">
                    <canvas id="barChart"></canvas>
                    <p class="m-2">*Data dalam bentuk persentase</p>
                </div>
                <div class="rounded m-auto border border-secondary p-2 chart" style="width: 50%;">
                    <canvas id="pieChart"></canvas>
                    <p class="m-2">*Data dalam bentuk persentase</p>
                </div>
            </div>
            <h2 class="text-center mt-5 mb-4">Control Grafik Kemantapan Jalan</h2>
            <div class="table-res w-75 m-auto mt-5">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Status</th>
                            <th scope="col">Persentase</th>
                        </tr>
                    </thead>
                    <form class="mb-5" action="" method="post">
                        <tbody class="text-center">
                            <?php foreach ($getdata as $a) : ?>
                            <tr>
                                <th scope="row" class="text-success">ASPAL</th>
                                <td><input class="border-1 rounded w-25 text-center" type="text"
                                        value="<?= $a['data1']; ?>" name="data1">
                                    %</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-warning">BETON</th>
                                <td><input class="border-1 rounded w-25 text-center" type="text"
                                        value="<?= $a['data2']; ?>" name="data2"> %</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-danger">TANAH</th>
                                <td><input class="border-1 rounded w-25 text-center" type="text"
                                        value="<?= $a['data3']; ?>" name="data3">
                                    %</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-danger">PAVING BLOK</th>
                                <td><input class="border-1 rounded w-25 text-center" type="text"
                                        value="<?= $a['data4']; ?>" name="data4">
                                    %</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
                <div class="shadow">
                    <button type="submit" name="update"
                        class="btn btn-warning mt-3 mb-5 p-1 px-2 float-end fw-bolder">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const getdata = <?php echo json_encode($getdata); ?>;

const barChartCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barChartCtx, {
    type: 'bar',
    data: {
        labels: ['ASPAL', 'BETON', 'TANAH', 'PAVING BLOK'],
        datasets: [{
            label: 'Kemantapan Jalan',
            data: [getdata.reduce((total, a) => total + a.data1, 0), getdata.reduce((total, a) =>
                total +
                a.data2, 0), getdata.reduce((total, a) => total + a.data3, 0), getdata.reduce((
                total, a) => total + a.data4, 0)],
            backgroundColor: ['green', 'yellow', 'red', 'brown']
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const pieChartCtx = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(pieChartCtx, {
    type: 'pie',
    data: {
        labels: ['ASPAL', 'BETON', 'TANAH', 'PAVING BLOK'],
        datasets: [{
            label: 'Kemantapan Jalan',
            data: [getdata.reduce((total, a) => total + a.data1, 0), getdata.reduce((total, a) =>
                total +
                a.data2, 0), getdata.reduce((total, a) => total + a.data3, 0), getdata.reduce((
                total, a) => total + a.data4, 0)],
            backgroundColor: ['green', 'yellow', 'red', 'brown']
        }]
    }
});
</script>
<?php include 'views/partials/starter-foot.php' ?>