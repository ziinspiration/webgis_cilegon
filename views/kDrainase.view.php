<?php include 'partials/starter-head.php' ?>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 mb-5 mt-5">
            <div style="width: 80%; margin: auto;">
                <canvas id="barChart"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-5 mt-5">
            <div style="width: 80%; margin: auto;">
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const barChartCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barChartCtx, {
        type: 'bar',
        data: {
            labels: ['Bagus', 'Sedang', 'Rusak'],
            datasets: [{
                label: 'Kemantapan Drainase',
                data: [10, 20, 15],
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
            labels: ['Bagus', 'Sedang', 'Rusak'],
            datasets: [{
                label: 'Kemantapan Drainase',
                data: [30, 45, 25],
                backgroundColor: ['green', 'yellow', 'red']
            }]
        }
    });
</script>

<?php include 'partials/starter-foot.php' ?>