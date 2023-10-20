<?php include 'views/partials/starter-head.php'; ?>
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
        .content {
            width: 95% !important;
        }

        .formulir {
            flex-direction: column;
        }

        .left,
        .right,
        .center {
            width: 100% !important;
            margin: 0 !important;
            flex-direction: column !important;
        }

        .file-now {
            font-size: 9px !important;
            margin-top: 5px !important;
        }

        .btn-primary {
            width: 100% !important;
        }

        .kolom {
            width: 100% !important;
            margin: 0 !important;
            margin-bottom: 50px !important;
        }

        .img-preview {
            display: none !important;
        }

        .preview-image {
            display: block !important;
            width: 30% !important;
            margin: auto !important;
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

    .img-preview {
        width: 10% !important;
        margin: auto !important;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 content align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Update data rencana</h2>
                <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />
                <input type="hidden" name="id_jenis_file" value="<?= $getdata['id_jenis_file']; ?>">

                <div class="formulir d-flex justify-content-between flex-column">
                    <div class="left w-100 mb-5 d-flex justify-content-between">
                        <!-- Nama data -->
                        <div class="w-50 me-3 kolom">
                            <label for="nama_rencana" class="form-label orange ps-1 pe-1">Nama data</label>
                            <input type="text" class="form-control p-2" id="nama_rencana" name="nama_rencana" value="<?= $getdata['nama_rencana']; ?>" required />
                        </div>
                        <!-- File geojson -->
                        <div class="w-50 ms-3 kolom">
                            <label for="file_json" class="form-label orange ps-1 pe-1">File geojson</label>
                            <div class="input-group">
                                <input type="file" class="form-control p-2" id="file_json" name="file_json" accept=".geojson" />
                                <label class="input-group-text p-2" for="file_json">Pilih file</label>
                            </div>
                            <div class="file-now text-light p-2">
                                <?php if (!empty($getdata['file_json'])) : ?>
                                    <p><small>File sekarang = <?= basename($getdata['file_json']); ?></small></p>
                                    <p class="text-danger"><small>*Jangan buat nama file sama dengan sebelumnya</small></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="center w-100 mb-5 d-flex justify-content-between">
                        <!-- Icon ID -->
                        <div class="w-50 me-3 kolom">
                            <label for="icon_id" class="form-label orange ps-1 pe-1">Icon ID</label>
                            <input type="text" class="form-control p-2" id="icon_id" name="icon_id" value="<?= $getdata['icon_id']; ?>" required />
                        </div>
                        <img class="img-preview" src="../assets/icon/rencana/<?= $getdata["icon"]; ?>" alt="Preview" id="preview" />
                    </div>
                </div>
                <div class="right w-100 mb-5 d-flex justify-content-between">
                    <!-- Checkbox ID -->
                    <div class="w-50 me-3 kolom">
                        <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox ID</label>
                        <input type="text" class="form-control p-2" id="checkbox_id" name="checkbox_id" value="<?= $getdata['checkbox_id']; ?>" required />
                    </div>
                    <!-- Icon -->
                    <img class="preview-image d-none" src="../assets/icon/rencana/<?= $getdata["icon"]; ?>" alt="Preview" id="preview" />
                    <div class="w-50 ms-3 kolom">
                        <label for="icon" class="form-label orange ps-1 pe-1">File icon</label>
                        <input type="file" onchange="previewImage(event)" class="form-control p-2" id="icon" name="icon" accept=".jpg, .jpeg, .png" />
                    </div>

                </div>
                <div class="center w-50">
                    <div class="mb-3">
                        <label for="hide" class="form-label orange ps-1 pe-1">Hide status</label>
                        <input type="hidden" name="hide">
                        <select name="hide" id="hide" class="form-select form-control p-2">
                            <?php
                            $currentHide = $getdata['hide'];
                            $sembunyikanSelected = ($currentHide == 0) ? "selected" : "";
                            $tampilkanSelected = ($currentHide == 1) ? "selected" : "";
                            ?>
                            <option value="0" <?= $sembunyikanSelected; ?>>Disembunyikan</option>
                            <option value="1" <?= $tampilkanSelected; ?>>Ditampilkan</option>
                        </select>
                    </div>
                </div>
                <div class="btn-kirim d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary w-25 p-2 mt-4 mb-4"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php'; ?>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php
if (isset($_POST["submit"])) {
    // Ambil data dari form dan lakukan pembersihan jika perlu
    $id = $_POST["id"];
    $nama_rencana = $_POST["nama_rencana"];
    $icon_id = $_POST["icon_id"];
    $checkbox_id = $_POST["checkbox_id"];
    $hide = $_POST["hide"];

    // cek apakah nama_rencana sudah ada dalam database
    $query_check_nama_rencana = "SELECT COUNT(*) FROM rencana WHERE nama_rencana = ? AND id != ?";
    $stmt_check_nama_rencana = mysqli_prepare($conn, $query_check_nama_rencana);
    mysqli_stmt_bind_param($stmt_check_nama_rencana, 'si', $nama_rencana, $id);
    mysqli_stmt_execute($stmt_check_nama_rencana);
    mysqli_stmt_bind_result($stmt_check_nama_rencana, $nama_rencana_count);
    mysqli_stmt_fetch($stmt_check_nama_rencana);
    mysqli_stmt_close($stmt_check_nama_rencana);

    if ($nama_rencana_count > 0) {
        echo "
           <script>
            Swal.fire({
                position: 'center-center',
                icon: 'error',
                title: 'Oops :(',
                text: 'Data gagal diupdate! Nama data sudah ada dalam database.',
                showConfirmButton: false,
                timer: 3500
            });
           </script>
        ";
        exit;
    }

    // cek apakah checkbox_id sudah ada dalam database
    $query_check_checkbox_id = "SELECT COUNT(*) FROM rencana WHERE checkbox_id = ? AND id != ?";
    $stmt_check_checkbox_id = mysqli_prepare($conn, $query_check_checkbox_id);
    mysqli_stmt_bind_param($stmt_check_checkbox_id, 'si', $checkbox_id, $id);
    mysqli_stmt_execute($stmt_check_checkbox_id);
    mysqli_stmt_bind_result($stmt_check_checkbox_id, $checkbox_id_count);
    mysqli_stmt_fetch($stmt_check_checkbox_id);
    mysqli_stmt_close($stmt_check_checkbox_id);

    if ($checkbox_id_count > 0) {
        echo "
           <script>
            Swal.fire({
                position: 'center-center',
                icon: 'error',
                title: 'Oops :(',
                text: 'Data gagal diupdate! Checkbox ID sudah ada dalam database.',
                showConfirmButton: false,
                timer: 3500
            });
           </script>
        ";
        exit;
    }

    // query update data rencana
    $query = "UPDATE rencana SET
        nama_rencana = '$nama_rencana',
        checkbox_id = '$checkbox_id',
        hide = '$hide',
        icon_id = '$icon_id'";

    // cek apakah ada file yang diupload
    if (!empty($_FILES['file_json']['name'])) {
        // Proses upload file
        $file_name = $_FILES["file_json"]["name"];
        $file_tmp = $_FILES["file_json"]["tmp_name"];
        $file_error = $_FILES["file_json"]["error"];

        if ($file_error === UPLOAD_ERR_OK) {
            $file_destination = '../assets/geojson/rencana/' . $file_name;

            // Pindahkan file ke folder tujuan
            move_uploaded_file($file_tmp, $file_destination);

            // Tambahkan query untuk update file
            $query .= ", file_json = '$file_name'";
        } else {
            // Error saat upload file
            echo "
               <script>
                Swal.fire({
                    position: 'center-center',
                    icon: 'error',
                    title: 'Oops :(',
                    text: 'Terjadi kesalahan saat upload file!',
                    showConfirmButton: false,
                    timer: 3500
                }).then(function() {
                    window.location.href = 'ubah-rencana.php';
                });
               </script>
            ";
            exit;
        }
    }

    // cek apakah ada file icon yang diupload
    if (!empty($_FILES['icon']['name'])) {
        // Proses upload icon
        $icon_name = $_FILES["icon"]["name"];
        $icon_tmp = $_FILES["icon"]["tmp_name"];
        $icon_error = $_FILES["icon"]["error"];

        if ($icon_error === UPLOAD_ERR_OK) {
            $icon_destination = '../assets/icon/rencana/' . $icon_name;

            // Cek ekstensi file icon
            $icon_extension = pathinfo($icon_name, PATHINFO_EXTENSION);
            $allowed_extensions = ['jpg', 'jpeg', 'png'];

            if (in_array($icon_extension, $allowed_extensions)) {
                // Pindahkan file icon ke folder tujuan
                move_uploaded_file($icon_tmp, $icon_destination);

                // Tambahkan query untuk update icon
                $query .= ", icon = '$icon_name'";
            } else {
                // Ekstensi file icon tidak valid
                echo "
                   <script>
                    Swal.fire({
                        position: 'center-center',
                        icon: 'error',
                        title: 'Oops :(',
                        text: 'Ekstensi file icon tidak valid. Harap pilih file dengan ekstensi JPG, JPEG, atau PNG.',
                        showConfirmButton: false,
                        timer: 3500
                    }).then(function() {
                        window.location.href = 'ubah-rencana.php';
                    });
                   </script>
                ";
                exit;
            }
        } else {
            // Error saat upload file icon
            echo "
               <script>
                Swal.fire({
                    position: 'center-center',
                    icon: 'error',
                    title: 'Oops :(',
                    text: 'Terjadi kesalahan saat upload file icon!',
                    showConfirmButton: false,
                    timer: 3500
                }).then(function() {
                    window.location.href = 'ubah-rencana.php';
                });
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
            Swal.fire({
                position: 'center-center',
                icon: 'success',
                title: 'Selamat :)',
                text: 'Data berhasil diupdate!',
                showConfirmButton: false,
                timer: 3500
            }).then(function() {
                window.location.href = 'ubah-rencana.php';
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
                window.location.href = 'ubah-rencana.php';
            });
           </script>
        ";
    }
}
?>


<?php include 'views/partials/starter-foot.php'; ?>