<?php include 'partials/starter-head.php' ?>
<style>
.note {
    font-family: Montserrat !important;
}
</style>
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
        <div class="note">
            <p>*Data dalam bentuk persentase</p>
        </div>
    </div>
</div>

<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const getdata = <?php echo json_encode($getdata); ?>;

const barChartCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barChartCtx, {
    type: 'bar',
    data: {
        labels: ['Baik', 'Sedang', 'Rusak'],
        datasets: [{
            label: 'Kemantapan Jalan',
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
            label: 'Kemantapan Jalan',
            data: [getdata.reduce((total, a) => total + a.good, 0), getdata.reduce((total, a) => total +
                a.normal, 0), getdata.reduce((total, a) => total + a.bad, 0)],
            backgroundColor: ['green', 'yellow', 'red']
        }]
    }
});
</script>

<?php include 'partials/starter-foot.php' ?>