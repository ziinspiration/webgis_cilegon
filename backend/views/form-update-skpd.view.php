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
                <h2 class="text-center text-light mb-5 mt-2">Update data SKPD</h2>
                <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />
                <div class="formulir">
                    <div class="left w-100 me-3">
                        <div class="mb-3">
                            <label for="nama_dinas" class="form-label orange ps-1 pe-1">Nama Dinas</label>
                            <input type="text" class="form-control p-2" id="nama_dinas" name="nama_dinas" value="<?= $getdata['nama_dinas']; ?>" required />
                        </div>
                    </div>
                    <div class="right w-100 me-3">
                        <div class="mb-3">
                            <label for="alamat" class="form-label orange ps-1 pe-1">Alamat Dinas</label>
                            <input type="text" class="form-control p-2" id="alamat" name="alamat" value="<?= $getdata['alamat']; ?>" required />
                        </div>
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

    // Ambil data dari form dan lakukan pembersihan dengan clean_input
    $id = $_POST["id"];
    $nama_dinas = clean_input($_POST["nama_dinas"]);
    $alamat = clean_input($_POST["alamat"]);

    // Cek apakah nama_dinas sudah ada dalam database
    $query_check_nama_dinas = "SELECT COUNT(*) FROM skpd WHERE nama_dinas = ? AND id != ?";
    $stmt_check_nama_dinas = mysqli_prepare($conn, $query_check_nama_dinas);
    mysqli_stmt_bind_param($stmt_check_nama_dinas, 'si', $nama_dinas, $id);
    mysqli_stmt_execute($stmt_check_nama_dinas);
    mysqli_stmt_bind_result($stmt_check_nama_dinas, $nama_dinas_count);
    mysqli_stmt_fetch($stmt_check_nama_dinas);
    mysqli_stmt_close($stmt_check_nama_dinas);

    if ($nama_dinas_count > 0) {
        echo "
           <script>
            Swal.fire({
                position: 'center-center',
                icon: 'error',
                title: 'Oops :(',
                text: 'Data gagal diupdate! Nama Dinas sudah ada dalam database.',
                showConfirmButton: false,
                timer: 3500
            });
           </script>
        ";
        exit;
    }

    // Update data di tabel skpd
    $query = "UPDATE skpd SET nama_dinas = ?, alamat = ? WHERE id = ?";
    $stmt_update = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt_update, 'ssi', $nama_dinas, $alamat, $id); // Ubah 'sssi' menjadi 'ssi'

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
                window.location.href = 'ubah-data-skpd';
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
                window.location.href = 'ubah-data-skpd';
            });
           </script>
        ";
    }
}
?>



<?php include 'views/partials/starter-foot.php' ?>