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
                <h2 class="text-center text-light mb-5 mt-2">Update data atribut rencana</h2>

                <div class="formulir">
                    <div class="left w-100 me-3">
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label orange ps-1 pe-1">Kecamatan</label>
                            <input type="text" class="form-control p-2" id="kecamatan" name="kecamatan"
                                value="<?= $getdata['kecamatan']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label orange ps-1 pe-1">Kelurahan</label>
                            <input type="text" class="form-control p-2" id="kelurahan" name="kelurahan"
                                value="<?= $getdata['kelurahan']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label orange ps-1 pe-1">Keterangan</label>
                            <input type="text" class="form-control p-2" id="keterangan" name="keterangan"
                                value="<?= $getdata['keterangan']; ?>" required />
                        </div>
                    </div>
                    <div class="right w-100 me-3">
                        <div class="mb-3">
                            <label for="sumber" class="form-label orange ps-1 pe-1">Sumber</label>
                            <input type="text" class="form-control p-2" id="sumber" name="sumber"
                                value="<?= $getdata['sumber']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="luas" class="form-label orange ps-1 pe-1">Luas</label>
                            <input type="text" class="form-control p-2" id="luas" name="luas"
                                value="<?= $getdata['luas']; ?>" required />
                        </div>
                        <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />
                        <input type="hidden" name="data_pokok_id" value="<?= $getdata['data_pokok_id']; ?>" />
                    </div>
                </div>
                <div class="btn-kirim d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary w-25 p-2 mt-4 mb-4"><i
                            class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
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
    $keterangan = $_POST["keterangan"];
    $kecamatan = $_POST["kecamatan"];
    $kelurahan = $_POST["kelurahan"];
    $sumber = $_POST["sumber"];
    $luas = $_POST["luas"];

    // query update data rencana
    $query = "UPDATE atribut_rencana SET
            keterangan = '$keterangan',
            kecamatan = '$kecamatan',
            kelurahan = '$kelurahan',
            sumber = '$sumber',
            luas = '$luas'
            WHERE id = $id AND data_pokok_id = $id_pokok";

    // cek apakah data berhasil diubah atau tidak
    if (mysqli_query($conn, $query)) {
        $successMessage = "Perubahan anda berhasil tersimpan";
        $redirectUrl = "ubah-atribut-rencana?id=" . urlencode($id_pokok);
        $icon = 'success';
    } else {
        $successMessage = "Data gagal diupdate!";
        $redirectUrl = "ubah-atribut-rencana?id=" . urlencode($id_pokok);
        $icon = 'error';
    }

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