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
                <h2 class="text-center text-light mb-5 mt-2">Update data wilayah</h2>
                <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />
                <div class="formulir d-flex justify-content-between">
                    <div class="left w-50 me-3">
                        <div class="mb-3">
                            <label for="id_desa" class="form-label orange ps-1 pe-1">ID Desa</label>
                            <input type="text" class="form-control p-2" id="id_desa" name="id_desa"
                                value="<?= $getdata['id_desa']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label orange ps-1 pe-1">Kecamatan</label>
                            <input type="text" class="form-control p-2" id="kecamatan" name="kecamatan"
                                value="<?= $getdata['kecamatan']; ?>" required />
                        </div>
                    </div>
                    <div class="right w-50 me-3">
                        <div class="mb-3">
                            <label for="ibukota" class="form-label orange ps-1 pe-1">Ibukota Kecamatan</label>
                            <input type="text" class="form-control p-2" id="ibukota" name="ibukota"
                                value="<?= $getdata['ibukota']; ?>" required />
                        </div>
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
    $id = $_POST["id"];
    $kecamatan = clean_input($_POST["kecamatan"]);
    $ibukota = clean_input($_POST["ibukota"]);
    $id_desa = clean_input($_POST["id_desa"]);

    // Cek apakah id_desa sudah ada dalam database
    $query_check_id_desa = "SELECT COUNT(*) FROM wilayah WHERE id_desa = ? AND id != ?";
    $stmt_check_id_desa = mysqli_prepare($conn, $query_check_id_desa);
    mysqli_stmt_bind_param($stmt_check_id_desa, 'si', $id_desa, $id);
    mysqli_stmt_execute($stmt_check_id_desa);
    mysqli_stmt_bind_result($stmt_check_id_desa, $id_desa_count);
    mysqli_stmt_fetch($stmt_check_id_desa);
    mysqli_stmt_close($stmt_check_id_desa);

    if ($id_desa_count > 0) {
        echo "
           <script>
            Swal.fire({
                position: 'center-center',
                icon: 'error',
                title: 'Oops :(',
                text: 'Data gagal diupdate! ID Desa sudah ada dalam database.',
                showConfirmButton: false,
                timer: 3500
            });
           </script>
        ";
        exit;
    }

    // Update data di tabel wilayah
    $query = "UPDATE wilayah SET kecamatan = ?, ibukota = ?, id_desa = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_update, 'sssi', $kecamatan, $ibukota, $id_desa, $id);

    if (mysqli_stmt_execute($stmt_update)) {
        mysqli_stmt_close($stmt_update);
        mysqli_close($conn);

        echo "
           <script> 
            Swal.fire({
                position: 'center-center',
                icon: 'success',
                title: 'Selamat :)',
                text: 'Perubahan berhasil tersimpan',
                showConfirmButton: false,
                timer: 3500
            }).then(function() {
                window.location.href = 'ubah-data-wilayah';
            });
           </script>
        ";
    } else {
        echo "
           <script>
            Swal.fire({
                position: 'center-center',
                icon: 'error',
                title: 'Oops :(',
                text: 'Data gagal diupdate!',
                showConfirmButton: false,
                timer: 3500
            }).then(function() {
                window.location.href = 'ubah-data-wilayah';
            });
           </script>
        ";
    }
}
?>


<?php include 'views/partials/starter-foot.php' ?>