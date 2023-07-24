<?php include 'views/partials/starter-head.php' ?>
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
                <h2 class="text-center text-light mb-5 mt-2">Update data administrasi</h2>
                <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />
                <div class="formulir d-flex justify-content-between">
                    <div class="left w-50 me-3">
                        <div class="mb-3">
                            <label for="nama_adm" class="form-label orange ps-1 pe-1">Nama data</label>
                            <input type="text" class="form-control p-2" id="nama_adm" name="nama_adm"
                                value="<?= $getdata['nama_adm']; ?>" required />
                        </div>
                        <div class="mb-3">
                            <label for="file_json" class="form-label orange ps-1 pe-1">File geojson</label>
                            <div class="input-group">
                                <input type="file" class="form-control p-2" id="file_json" name="file_json"
                                    accept=".geojson" />
                                <label class="input-group-text p-2" for="file_json"><i
                                        class="fa-solid fa-magnifying-glass"></i></label>
                            </div>
                            <div class="file-now text-light p-2">
                                <?php if (!empty($getdata['file_json'])) : ?>
                                <p><small>File sekarang = <?= basename($getdata['file_json']); ?></small></p>
                                <p class="text-danger"><small>*Jangan buat nama file sama dengan sebelumnya</small></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="right w-50 me-3">
                        <div class="mb-3">
                            <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox ID</label>
                            <input type="text" class="form-control p-2" id="checkbox_id" name="checkbox_id"
                                value="<?= $getdata['checkbox_id']; ?>" required />
                        </div>
                    </div>
                </div>
                <div class="btn-kirim d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary w-25 p-2 mt-4"><i
                            class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php' ?>

<?php
if (isset($_POST["submit"])) {
    // ambil data dari form
    $id = $_POST["id"];
    $nama_adm = $_POST["nama_adm"];
    $checkbox_id = $_POST["checkbox_id"];

    // query update data administrasi
    $query = "UPDATE administrasi SET
            nama_adm = '$nama_adm',
            checkbox_id = '$checkbox_id'";

    // cek apakah ada file yang diupload
    if (!empty($_FILES['file_json']['name'])) {
        // Proses upload file
        $file_name = $_FILES["file_json"]["name"];
        $file_tmp = $_FILES["file_json"]["tmp_name"];
        $file_error = $_FILES["file_json"]["error"];

        // Cek apakah file berhasil diupload dan tidak ada error
        if ($file_error === UPLOAD_ERR_OK) {
            $file_destination = '../assets/geojson/administrasi/' . $file_name;

            // Pindahkan file ke folder tujuan
            move_uploaded_file($file_tmp, $file_destination);

            // Tambahkan query untuk update file
            $query .= ", file_json = '$file_name'";
        } else {
            // Error saat upload file
            echo "
               <script>
                alert('Terjadi kesalahan saat upload file!');
                document.location.href = 'ubah-administrasi.php';
               </script>
            ";
            exit;
        }
    }

    $query .= " WHERE id = $id";

    // cek apakah data berhasil diubah atau tidak
    if (mysqli_query($conn, $query)) {
        echo "
           <script> 
            alert('Data berhasil diupdate!');
            document.location.href = 'ubah-administrasi.php';
           </script>
        ";
    } else {
        echo "
           <script>
            alert('Data gagal diupdate!');
            document.location.href = 'ubah-administrasi.php';
           </script>
        ";
    }
}
?>

<?php include 'views/partials/starter-foot.php' ?>