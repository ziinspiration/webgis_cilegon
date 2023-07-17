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
                <p><?= $salam; ?>, <?= $nama; ?></p>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>