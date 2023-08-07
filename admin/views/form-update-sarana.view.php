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

        .view-change-img {
            margin: auto !important;
            margin-bottom: 30px !important;
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

    .view-change-img {
        height: 150px !important;
        width: 150px !important;
    }

    .img-preview {
        height: 90px !important;
        width: 90px !important;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 content align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="POST" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Update data sarana</h2>
                <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />

                <div class="right w-100 mb-5 d-flex justify-content-between">
                    <div class="w-50 me-3 kolom">
                        <label for="nama_sarana" class="form-label orange ps-1 pe-1">Nama data</label>
                        <input type="text" class="form-control p-2" id="nama_sarana" name="nama_sarana" value="<?= $getdata['nama_sarana']; ?>" required />
                    </div>

                    <div class="w-50 ms-3 kolom">
                        <label for="file_json" class="form-label orange ps-1 pe-1">File geojson</label>
                        <div class="input-group">
                            <input type="file" class="form-control p-2" id="file_json" name="file_json" accept=".geojson" />
                            <label class="input-group-text p-2" for="file_json">Pilih file</label>
                            <div class="file-now text-light p-2">
                                <?php if (!empty($getdata['file_json'])) : ?>
                                    <p><small>File sekarang = <?= basename($getdata['file_json']); ?></small></p>
                                    <p class="text-danger"><small>*Jangan buat nama file sama dengan sebelumnya</small></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if ($getdata['id_jenis_sarana'] === '1') : ?>
                    <div class="view-change-img mb-3 d-flex align-items-center justify-content-center p-5 rounded-circle bg-light">
                        <img class="img-preview" src="../assets/icon/sarana/<?= $getdata["icon"]; ?>" alt="Preview" id="preview" />
                    </div>
                <?php endif; ?>

                <?php if ($getdata['id_jenis_sarana'] === '1') : ?>
                    <div class="center w-100 mb-5 d-flex justify-content-between">
                        <div class="w-50 me-3 kolom">
                            <label for="icon" class="form-label orange ps-1 pe-1">Icon file</label>
                            <input type="file" onchange="previewImage(event)" class="form-control p-2" id="icon" name="icon" accept=".jpg, .jpeg, .png" />
                        </div>

                        <div class="w-50 ms-3 kolom">
                            <label for="icon_id" class="form-label orange ps-1 pe-1">Icon ID</label>
                            <input type="text" class="form-control p-2" id="icon_id" name="icon_id" value="<?= $getdata['icon_id']; ?>" required />
                        </div>
                    </div>
                <?php endif; ?>
                <div class="right w-100 mb-5 d-flex justify-content-between">
                    <div class="w-100 mb-5 me-3 kolom mb-5">
                        <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox ID</label>
                        <input type="text" class="form-control p-2" id="checkbox_id" name="checkbox_id" value="<?= $getdata['checkbox_id']; ?>" required />
                    </div>

                    <div class="w-100 mb-5 ms-3 kolom">
                        <label for="kategoriSelect" class="form-label orange ps-1 pe-1">Kategori</label>
                        <input type="hidden" name="kategori_id" value="<?= $getdata['kategori_id']; ?>">
                        <select name="kategori_id" id="kategoriSelect" class="form-select form-control p-2" aria-label="Default select example">
                            <option selected disabled>Pilih jenis kategori</option>
                            <?php foreach ($getkategori as $a) : ?>
                                <option value="<?= $a['id_kategori']; ?>">
                                    <?= $a['nama_kategori']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="btn-kirim d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-primary w-25 p-2 mt-4 mb-4"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'views/partials/script.php' ?>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block'; // Tampilkan gambar pratinjau
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <?php
    if (isset($_POST["submit"])) {
        // Ambil data dari form dan lakukan pembersihan jika perlu
        $id = $_POST["id"];
        $nama_sarana = $_POST["nama_sarana"];
        $icon_id = $_POST["icon_id"];
        $checkbox_id = $_POST["checkbox_id"];
        $kategori_id = $_POST["kategori_id"];

        // cek apakah nama_sarana sudah ada dalam database
        $query_check_nama_sarana = "SELECT COUNT(*) FROM sarana WHERE nama_sarana = ? AND id != ?";
        $stmt_check_nama_sarana = mysqli_prepare($conn, $query_check_nama_sarana);
        mysqli_stmt_bind_param($stmt_check_nama_sarana, 'si', $nama_sarana, $id);
        mysqli_stmt_execute($stmt_check_nama_sarana);
        mysqli_stmt_bind_result($stmt_check_nama_sarana, $nama_sarana_count);
        mysqli_stmt_fetch($stmt_check_nama_sarana);
        mysqli_stmt_close($stmt_check_nama_sarana);

        if ($nama_sarana_count > 0) {
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
        $query_check_checkbox_id = "SELECT COUNT(*) FROM sarana WHERE checkbox_id = ? AND id != ?";
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

        // query update data sarana
        $query = "UPDATE sarana SET
        nama_sarana = '$nama_sarana',
        checkbox_id = '$checkbox_id',
        icon_id = '$icon_id',
        kategori_id = '$kategori_id'";

        // cek apakah ada file yang diupload
        if (!empty($_FILES['file_json']['name'])) {
            // Proses upload file
            $file_name = $_FILES["file_json"]["name"];
            $file_tmp = $_FILES["file_json"]["tmp_name"];
            $file_error = $_FILES["file_json"]["error"];

            if ($file_error === UPLOAD_ERR_OK) {
                $file_destination = '../assets/geojson/sarana/' . $file_name;

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
                    window.location.href = 'ubah-sarana.php';
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
                $icon_destination = '../assets/icon/sarana/' . $icon_name;

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
                        window.location.href = 'ubah-sarana.php';
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
                    window.location.href = 'ubah-sarana.php';
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
                window.location.href = 'ubah-sarana.php';
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
                window.location.href = 'ubah-sarana.php';
            });
           </script>
        ";
        }
    }
    ?>


    <?php include 'views/partials/starter-foot.php' ?>