<?php
include 'views/partials/starter-head.php';
if (isset($_POST['update'])) {
    $good = clean_input($_POST['good']);
    $normal = clean_input($_POST['normal']);
    $bad = clean_input($_POST['bad']);

    if (!empty($good) && !empty($normal) && !empty($bad)) {
        $total = $good + $normal + $bad;
        if ($total == 100) {
            $query = "UPDATE status_kemantapan SET good = ?, normal = ?, bad = ? WHERE nama_data = 'kemantapan_drainase'";

            $stmt = $conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iii", $good, $normal, $bad);

                if ($stmt->execute()) {
                    // SweetAlert success message
                    echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "Data berhasil diupdate.",
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = "data-kemantapan-drainase"; 
                    });
                </script>';
                } else {
                    // SweetAlert error message
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Terjadi kesalahan saat mengupdate data",
                            text: "' . $stmt->error . '"
                        });
                    </script>';
                }

                $stmt->close();
            } else {
                // SweetAlert error message
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Terjadi kesalahan saat mempersiapkan statement",
                        text: "' . $conn->error . '"
                    });
                </script>';
            }
        } else {
            // SweetAlert warning message
            echo '<script>
                Swal.fire({
                    icon: "warning",
                    title: "Total harus berjumlah 100%"
                });
            </script>';
        }
    } else {
        // SweetAlert error message
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Input tidak boleh kosong"
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
            <h2 class="text-center mt-5 mb-4">Control Grafik Kemantapan Drainase</h2>
            <div class="table-res w-75 m-auto mt-5">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">Status</th>
                            <th scope="col">Persentase</th>
                        </tr>
                    </thead>
                    <form action="" method="post">
                        <tbody class="text-center">
                            <?php foreach ($getdata as $a) : ?>
                            <tr>
                                <th scope="row" class="text-success">Baik</th>
                                <td><input class="border-1 rounded w-25 text-center" type="text"
                                        value="<?= $a['good']; ?>" name="good">
                                    %</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-warning">Sedang</th>
                                <td><input class="border-1 rounded w-25 text-center" type="text"
                                        value="<?= $a['normal']; ?>" name="normal">%</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-danger">Buruk</th>
                                <td><input class="border-1 rounded w-25 text-center" type="text"
                                        value="<?= $a['bad']; ?>" name="bad">
                                    %</td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
                <div class="shadow">
                    <button type="submit" name="update"
                        class="btn btn-warning mt-3 p-1 px-2 float-end fw-bolder">Update</button>
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
        labels: ['Baik', 'Sedang', 'Rusak'],
        datasets: [{
            label: 'Kemantapan Drainase',
            data: [getdata.reduce((total, a) => total + a.good, 0), getdata.reduce((total, a) => total +
                a.normal, 0), getdata.reduce((total, a) => total + a.bad, 0)],
            backgroundColor: ['green', 'yellow', 'red']
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
        labels: ['Baik', 'Sedang', 'Rusak'],
        datasets: [{
            label: 'Kemantapan Drainase',
            data: [getdata.reduce((total, a) => total + a.good, 0), getdata.reduce((total, a) => total +
                a.normal, 0), getdata.reduce((total, a) => total + a.bad, 0)],
            backgroundColor: ['green', 'yellow', 'red']
        }]
    }
});
</script>
<?php include 'views/partials/starter-foot.php' ?>