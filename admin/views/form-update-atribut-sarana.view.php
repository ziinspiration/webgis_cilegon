<?php include 'views/partials/starter-head.php' ?>
<?php include 'views/partials/alert-tambah-data.php'; ?>
<style>
    * {
        font-family: montserrat;
    }

    body {
        background-image: url(../assets/index/footer2.jpg);
    }

    .orange {
        color: orange !important;
    }

    .bg-orange {
        background-color: orange;
    }

    form {
        border: 2px solid orange !important;
    }

    @media screen and (max-width:550px) {
        .formulir {
            flex-direction: column;
        }

        .left,
        .right {
            width: 100% !important;
            margin: 0 !important;
        }

        .file-now {
            font-size: 9px !important;
            margin-top: 5px !important;
        }

        .btn-primary {
            width: 100% !important;
        }
    }

    @media screen and (max-width:990px) {
        .file-now {
            font-size: 11px !important;
            margin-top: 5px !important;
        }
    }

    .row {
        margin-top: 100px !important;
        margin-bottom: 100px !important;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Update data atribut sarana</h2>

                <div class="formulir">
                    <div class="left w-100 me-3">
                        <div class="mb-3">
                            <label for="nama" class="form-label orange ps-1 pe-1">Nama</label>
                            <input type="text" class="form-control p-2" id="nama" name="nama" value="<?= $getdata['nama']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label orange ps-1 pe-1">Keterangan</label>
                            <input type="text" class="form-control p-2" id="keterangan" name="keterangan" value="<?= $getdata['keterangan']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="jenis" class="form-label orange ps-1 pe-1">Jenis</label>
                            <input type="text" class="form-control p-2" id="jenis" name="jenis" value="<?= $getdata['jenis']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="x" class="form-label orange ps-1 pe-1">X</label>
                            <input type="text" class="form-control p-2" id="x" name="x" value="<?= $getdata['x']; ?>" />
                        </div>
                    </div>
                    <div class="right w-100 me-3">
                        <div class="mb-3">
                            <label for="y" class="form-label orange ps-1 pe-1">Y</label>
                            <input type="text" class="form-control p-2" id="y" name="y" value="<?= $getdata['y']; ?>" required />
                        </div>
                        <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />
                        <input type="hidden" name="data_pokok_id" value="<?= $getdata['data_pokok_id']; ?>" />
                    </div>
                </div>
                <div class="btn-kirim d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary w-25 p-2 mt-4 mb-4"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php' ?>

<?php
if (isset($_POST["submit"])) {
    // Ambil data dari form dan lakukan pembersihan jika perlu
    $id = $_POST["id"];
    $id_pokok = $_POST["data_pokok_id"];
    $jenis = $_POST["jenis"];
    $x = $_POST["x"];
    $nama = $_POST["nama"];
    $keterangan = $_POST["keterangan"];
    $y = $_POST["y"];

    // query update data sarana
    $query = "UPDATE atribut_sarana SET
            nama = '$nama',
            keterangan = '$keterangan',
            x = '$x',
            y = '$y',
            jenis = '$jenis'
            WHERE id = $id AND data_pokok_id = $id_pokok";

    // Ambil objek koneksi dari fungsi koneksi()
    $conn = koneksi(); // Pastikan fungsi koneksi() mengembalikan objek koneksi

    if (mysqli_query($conn, $query)) {
        $successMessage = "Perubahan anda berhasil tersimpan";
        $redirectUrl = "ubah-atribut-sarana?id=" . urlencode($id_pokok);
        $icon = 'success';
    } else {
        $successMessage = "Data gagal diupdate!";
        $redirectUrl = "ubah-atribut-sarana?id=" . urlencode($id_pokok);
        $icon = 'error';
    }

    // Tampilkan pesan menggunakan SweetAlert
    echo "
    <script>
    Swal.fire({
        position: 'center-center',
        icon: '$icon',
        title: '" . addslashes($successMessage) . "',
        showConfirmButton: false,
        timer: 3500
    }).then(function() {
        window.location.href = '$redirectUrl';
    });
    </script>
    ";
}
?>


<?php include 'views/partials/starter-foot.php' ?>