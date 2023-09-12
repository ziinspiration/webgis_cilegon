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

    .content {
        font-family: arial !important;
        font-size: 15px !important;
    }

    .q {
        font-family: Montserrat !important;
    }

    .card {
        margin-top: 20px !important;
        margin-bottom: 30px !important;
    }

    #profile-icon {
        font-size: 20px !important;
    }

    .hr-secondary {
        color: grey !important;
    }

    .btn-carousel {
        opacity: 0 !important;
    }

    form {
        font-family: Poppins !important;
    }
</style>
<div class="container mb-5 mt-5">
    <?php if (!empty($getdata)) : ?>
        <div class="main card p-3 bg-body-tertiary">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php $first = true; ?>
                    <?php foreach ($getdata as $a) : ?>
                        <div class="carousel-item <?php echo $first ? 'active' : ''; ?>">
                            <div class="">
                                <div class="content">
                                    <div class="question">
                                        <p class="m-0 q mb-1"><b><span class="me-1" id="profile-icon"><i class="bi bi-person-circle"></i></span><?= $a['nama_pengguna']; ?></b>
                                        </p>
                                        <p class="text-secondary m-0 mb-3 ms-4"><?= date('F j, Y', strtotime($a['date'])); ?>
                                        </p>
                                        <p class="m-0 mb-1 ms-2">" <?= $a['isi']; ?> "</p>
                                    </div>
                                    <p class="mt-3 mb-0 ms-1 text-secondary">Jawaban</p>
                                    <div class="answer mb-3 bg-body-secondary p-3 rounded border">
                                        <p class="m-0 q"><b>Admin Webgis Cilegon</b></p>
                                        <hr class="hr-secondary">

                                        <?php if (!empty($a['jawaban'])) : ?>
                                            <p class="m-0 mt-2 ms-2">" <?= $a['jawaban']; ?> "</p>
                                        <?php else : ?>
                                            <p class="m-0 mt-2 ms-2">" <?= $a['jawaban_otomatis']; ?> "</p>
                                            <p class="text-danger mt-2 ms-1"><small>*ini adalah jawaban otomatis</small></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $first = false; ?>
                    <?php endforeach; ?>
                </div>
                <div class="btn-carousel">
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <p class="text-danger ms-3 mb-2">*Klik bagian kiri atau kanan card untuk menggeser</p>
        </div>
    <?php endif; ?>


    <br>

    <div class="card pb-5 px-4 mt-5 pt-3 rounded bg-body-tertiary">
        <form action="" method="post">
            <h2 class="text-center mb-5 mt-3">Saran & Kritik</h2>
            <div class="form-floating mb-3 text-secondary">
                <input type="text" class="form-control pt-4" id="nama_pengguna" name="nama_pengguna" placeholder="Masukkan nama anda disini">
                <label for="nama_pengguna">Nama Pengguna</label>
            </div>
            <div class="form-floating mb-3 text-secondary">
                <textarea class="form-control" name="isi" id="floatingTextarea2" style="height: 100px"></textarea>
                <label for="floatingTextarea2">Saran & Kritikan</label>
            </div>
            <input type="hidden" name="jawaban_otomatis" value="Terima kasih atas saran dan kritik Anda. Kami menghargai kontribusi anda untuk meningkatkan layanan WebGIS kami. Kami akan terus berusaha memperbaiki platform kami sesuai masukan Anda. Terima kasih atas dukungan Anda.">
            <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
            </div>
        </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama_pengguna = cleaner($_POST["nama_pengguna"]);
        $isi = cleaner($_POST["isi"]);
        $jawaban_otomatis = cleaner($_POST["jawaban_otomatis"]);

        // Atur zona waktu sesuai dengan zona waktu yang Anda inginkan
        date_default_timezone_set('Asia/Jakarta'); // Gantilah dengan zona waktu yang sesuai

        $date = date("Y-m-d");

        $conn = koneksi();

        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO saran_kritik (nama_pengguna, isi, date, jawaban, jawaban_otomatis) VALUES ('$nama_pengguna', '$isi', '$date', '', '$jawaban_otomatis')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
       Swal.fire({
           title: 'Berhasil!',
           text: 'Hai $nama_pengguna, Terima kasih atas komentarmu!',
    icon: 'success',
    showConfirmButton: false,
    timer: 4500
    }).then(function() {
    window.location.href = 'saran-kritik.php';
    });
    </script>";
            exit;
        } else {
            echo "<script>
    Swal.fire({
        title: 'Gagal!',
        text: 'Terjadi kesalahan saat menambahkan komentar.',
        icon: 'error',
        showConfirmButton: false,
        timer: 1500
    });
    </script>";
        }
        mysqli_close($conn);
    }
    ?>

</div>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var carousel = document.getElementById('carouselExample');
    var carouselInstance = new bootstrap.Carousel(carousel, {
        interval: 4000
    });
</script>

<?php include 'partials/starter-foot.php' ?>