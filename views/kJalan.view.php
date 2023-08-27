<?php include 'partials/starter-head.php' ?>
<style>
.note {
    font-family: Montserrat !important;
}
</style>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>

<div class="container mt-5 mb-5 overflow-hidden">
    <div class="row">
        <div class="col-md-6 mb-3 mt-3">
            <div style="width: 80%; margin: auto;">
                <canvas data-aos="fade-right" data-aos-duration="1100" class="shadow card p-3 rounded-3"
                    id="barChart"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-3 mt-3">
            <div style="width: 80%; margin: auto;">
                <canvas data-aos="fade-left" data-aos-duration="1100" class="shadow card p-3 rounded-3"
                    id="pieChart"></canvas>
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
        labels: ['ASPAL', 'BETON', 'TANAH', 'PAVING BLOK'],
        datasets: [{
            label: 'Kemantapan Jalan',
            data: [getdata.reduce((total, a) => total + a.data1, 0), getdata.reduce((total, a) =>
                total +
                a.data2, 0), getdata.reduce((total, a) => total + a.data3, 0), getdata.reduce((
                total, a) => total + a.data4, 0)],
            backgroundColor: ['rgba(0, 150, 136, 0.7)', 'rgba(255, 152, 0, 0.7)',
                'rgba(255, 235, 59, 0.7)', 'rgba(63, 81, 181, 0.7)'
            ]
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
    type: 'doughnut',
    data: {
        labels: ['ASPAL', 'BETON', 'TANAH', 'PAVING BLOK'],
        datasets: [{
            label: 'Kemantapan Jalan',
            data: [getdata.reduce((total, a) => total + a.data1, 0), getdata.reduce((total, a) =>
                total +
                a.data2, 0), getdata.reduce((total, a) => total + a.data3, 0), getdata.reduce((
                total, a) => total + a.data4, 0)],
            backgroundColor: ['rgba(0, 150, 136, 0.7)', 'rgba(255, 152, 0, 0.7)',
                'rgba(255, 235, 59, 0.7)', 'rgba(63, 81, 181, 0.7)'
            ]
        }]
    }
});
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init();
</script>


<?php include 'partials/starter-foot.php' ?>