<?php include 'views/partials/starter-head.php' ?>
<?php
date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu sesuai kebutuhan

$jam = date('H'); // Mendapatkan jam saat ini (format 24 jam)

if ($jam >= 3 && $jam < 10) {
    $salam = 'Selamat Pagi';
} elseif ($jam >= 10 && $jam < 15) {
    $salam = 'Selamat Siang';
} elseif ($jam >= 15 && $jam < 18) {
    $salam = 'Selamat Sore';
} else {
    $salam = 'Selamat Malam';
}

?>
<style>
.container-fluid {
    background-image: url('../assets/index/dashboard.jpg');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top right;
    background-color: #f0f0f0;
    min-height: 100vh;
}

.content {
    background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0));
    width: 100%;
}

@media screen and (max-width: 576px) {
    .container-fluid {
        background-position: center;
    }

    .content {
        text-align: center;
    }

    .container-fluid {
        background-size: 70vh 100%;
        background-repeat: no-repeat;
        background-position-y: 350px;
        background-blend-mode: darken;
    }

    .col-md-9 {
        min-height: 70vh;
    }
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
            <div class="content">
                <h2>Selamat Datang</h2>
                <p><?= $salam; ?>, <?= $nama_pegawai; ?></p>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>