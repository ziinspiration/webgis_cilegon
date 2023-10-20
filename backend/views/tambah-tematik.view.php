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
        .formulir {
            flex-direction: column;
        }

        .left,
        .right {
            width: 100% !important;
            margin: 0 !important;
        }

        .note {
            font-size: 11px !important;
            margin-top: 5px !important;
        }
    }

    @media screen and (max-width:990px) {
        .note {
            font-size: 11px !important;
            margin-top: 5px !important;
        }
    }

    .row {
        margin-top: 100px !important;
    }
</style>
<?php
if (isset($_POST['send'])) {
    $nama_tematik = clean_input($_POST['nama_tematik']);
    $checkbox_id = clean_input($_POST['checkbox_id']);
    $kategori = clean_input($_POST['kategori']);
    $id_jenis_file = clean_input($_POST['id_jenis_file']);
    $icon_id = (isset($_POST['icon_id'])) ? clean_input($_POST['icon_id']) : '0';

    $icon = '0';

    // Cek apakah file JSON telah diunggah
    if (isset($_FILES['file_json']) && $_FILES['file_json']['error'] === UPLOAD_ERR_OK) {
        // Mendapatkan informasi file JSON
        $file_name = $_FILES['file_json']['name'];
        $file_tmp = $_FILES['file_json']['tmp_name'];

        // Cek apakah nama_tematik sudah ada dalam database
        $query_check_nama_tematik = "SELECT COUNT(*) FROM tematik WHERE nama_tematik = ?";
        $stmt_check_nama_tematik = mysqli_prepare($conn, $query_check_nama_tematik);
        mysqli_stmt_bind_param($stmt_check_nama_tematik, 's', $nama_tematik);
        mysqli_stmt_execute($stmt_check_nama_tematik);
        mysqli_stmt_bind_result($stmt_check_nama_tematik, $nama_tematik_count);
        mysqli_stmt_fetch($stmt_check_nama_tematik);
        mysqli_stmt_close($stmt_check_nama_tematik);

        if ($nama_tematik_count > 0) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengirim data!',
                    text: 'Nama data sudah ada dalam database.',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'daftar-tematik';
                    }
                });
            </script>";
            exit;
        }

        // Cek apakah checkbox_id sudah ada dalam database
        $query_check_checkbox_id = "SELECT COUNT(*) FROM tematik WHERE checkbox_id = ?";
        $stmt_check_checkbox_id = mysqli_prepare($conn, $query_check_checkbox_id);
        mysqli_stmt_bind_param($stmt_check_checkbox_id, 's', $checkbox_id);
        mysqli_stmt_execute($stmt_check_checkbox_id);
        mysqli_stmt_bind_result($stmt_check_checkbox_id, $checkbox_id_count);
        mysqli_stmt_fetch($stmt_check_checkbox_id);
        mysqli_stmt_close($stmt_check_checkbox_id);

        if ($checkbox_id_count > 0) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengirim data!',
                    text: 'Checkbox ID sudah ada dalam database.',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'daftar-tematik';
                    }
                });
            </script>";
            exit;
        }

        // Pindahkan file JSON ke direktori tujuan
        $upload_dir = '../assets/geojson/tematik/';
        $upload_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // Cek apakah file icon telah diunggah
            if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                // Mendapatkan informasi file icon
                $file_icon_name = $_FILES['icon']['name'];
                $file_icon_tmp = $_FILES['icon']['tmp_name'];

                // Pindahkan file icon ke direktori tujuan
                $upload_icon_dir = '../assets/icon/tematik/';
                $upload_icon_path = $upload_icon_dir . $file_icon_name;
                if (move_uploaded_file($file_icon_tmp, $upload_icon_path)) {
                    $icon = $file_icon_name;
                } else {
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal mengunggah file icon!',
                            showConfirmButton: true,
                        });
                    </script>";
                }
            }

            // Memasukkan data ke tabel tematik
            $query = "INSERT INTO tematik (nama_tematik, file_json, icon, icon_id, checkbox_id, id_jenis_file, kategori) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssssssi', $nama_tematik, $file_name, $icon, $icon_id, $checkbox_id, $id_jenis_file, $kategori);

            // Menjalankan query
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Data berhasil ditambahkan!',
                        showConfirmButton: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'daftar-tematik';
                        }
                    });
                </script>";
                exit;
            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menambahkan data.',
                        showConfirmButton: true,
                    });
                </script>";
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengunggah file GeoJSON!',
                    showConfirmButton: true,
                });
            </script>";
        }
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Pilih file GeoJSON yang valid!',
                showConfirmButton: true,
            });
        </script>";
    }

    // Menutup koneksi database
    mysqli_close($conn);
}
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4 mb-5" action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Input data tematik</h2>
                <div class="formulir d-flex justify-content-between">
                    <div class="left w-50 me-3">
                        <!-- Nama -->
                        <div class="mb-3 kolom">
                            <label for="nama_tematik" class="form-label orange ps-1 pe-1">Nama data</label>
                            <input type="text" name="nama_tematik" class="form-control p-2" id="nama_tematik" placeholder="Masukkan nama data" required />
                        </div>
                        <!-- File -->
                        <div class="mb-3 kolom">
                            <label for="file_json" class="form-label orange ps-1 pe-1">File GeoJSON</label>
                            <input type="file" class="form-control p-2" id="file_json" name="file_json" accept=".geojson" required />
                        </div>
                        <div class=" mb-3" id="icon_section">
                            <label for="icon" class="form-label orange ps-1 pe-1">File Icon</label>
                            <input type="file" class="form-control p-2" id="icon" name="icon" accept=".jpg, .jpeg, .png" />
                        </div>
                        <!-- Icon id -->
                        <div class=" mb-3" id="icon_id_section">
                            <label for="icon_id" class="form-label orange ps-1 pe-1">Icon ID</label>
                            <input type="text" name="icon_id" class="form-control p-2" id="icon_id" placeholder="*Wajib di isi untuk pembuatan icon" />
                            <p class="text-danger ms-3"><small>Contoh : IconRencanaA</small></p>
                        </div>
                    </div>
                    <div class="right w-50 ms-3 ">
                        <!-- Checkbox id -->
                        <div class="mb-3 kolom">
                            <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox</label>
                            <input type="text" name="checkbox_id" class="form-control p-2" id="checkbox_id" placeholder="*Wajib di isi untuk pembuatan checkbox" required />
                            <p class="text-danger note"><small>Contoh : JaringanJalanCheckbox</small></p>
                        </div>
                        <!-- id_jenis_file -->
                        <div class="mb-3 kolom">
                            <label for="kategori" class="form-label orange ps-1 pe-1">Kategori</label>
                            <select name="kategori" id="kategori" class="form-select form-control p-2" required>
                                <option selected disabled>Pilih kategori</option>
                                <?php foreach ($getKategori as $a) : ?>
                                    <option value="<?= $a['id_kategori']; ?>"><?= $a['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Jenis file -->
                        <div class="mb-3 kolom">
                            <label for="id_jenis_file" class="form-label orange ps-1 pe-1">Jenis file</label>
                            <select name="id_jenis_file" id="id_jenis_file" class="form-select form-control p-2" required>
                                <option selected disabled>Pilih jenis file</option>
                                <?php foreach ($getJenisFile as $a) : ?>
                                    <option value="<?= $a['jenis_file_id']; ?>"><?= $a['nama_jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="btn-kirim d-flex justify-content-end">
                    <button type="submit" name="send" class="btn btn-primary w-25 p-2 mt-4"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>