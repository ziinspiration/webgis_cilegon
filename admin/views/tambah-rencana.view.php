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
<?php
if (isset($_POST['send'])) {
    // Mendapatkan data dari form
    $nama_rencana = htmlspecialchars($_POST['nama_rencana']);
    $id_jenis_file = $_POST['id_jenis_file'];

    // Atur nilai icon dan icon_id menjadi 0 jika jenis file adalah "marker" (ID 1)
    $icon = ($id_jenis_file == 1 && isset($_POST['icon'])) ? htmlspecialchars($_POST['icon']) : '0';
    $icon_id = ($id_jenis_file == 1) ? htmlspecialchars($_POST['icon_id']) : '0';

    $checkbox_id = htmlspecialchars($_POST['checkbox_id']);

    // Cek apakah file JSON telah diunggah
    if (isset($_FILES['file_json']) && $_FILES['file_json']['error'] === UPLOAD_ERR_OK) {
        // Mendapatkan informasi file JSON
        $file_name = $_FILES['file_json']['name'];
        $file_tmp = $_FILES['file_json']['tmp_name'];

        // Cek apakah nama_rencana sudah ada dalam database
        $query_check_nama_rencana = "SELECT COUNT(*) FROM rencana WHERE nama_rencana = ?";
        $stmt_check_nama_rencana = mysqli_prepare($conn, $query_check_nama_rencana);
        mysqli_stmt_bind_param($stmt_check_nama_rencana, 's', $nama_rencana);
        mysqli_stmt_execute($stmt_check_nama_rencana);
        mysqli_stmt_bind_result($stmt_check_nama_rencana, $nama_rencana_count);
        mysqli_stmt_fetch($stmt_check_nama_rencana);
        mysqli_stmt_close($stmt_check_nama_rencana);

        if ($nama_rencana_count > 0) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengirim data!',
                    text: 'Nama data sudah ada dalam database.',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'daftar-rencana';
                    }
                });
            </script>";
            exit;
        }

        // Cek apakah checkbox_id sudah ada dalam database
        $query_check_checkbox_id = "SELECT COUNT(*) FROM rencana WHERE checkbox_id = ?";
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
                        window.location.href = 'daftar-rencana';
                    }
                });
            </script>";
            exit;
        }

        // Pindahkan file JSON ke direktori tujuan
        $upload_dir = '../assets/geojson/rencana/';
        $upload_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // Cek apakah file icon telah diunggah jika jenis file adalah "marker" (ID 1)
            if ($id_jenis_file == 1 && isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
                // Mendapatkan informasi file icon
                $file_icon_name = $_FILES['icon']['name'];
                $file_icon_tmp = $_FILES['icon']['tmp_name'];

                // Mendapatkan ekstensi file icon
                $file_icon_ext = strtolower(pathinfo($file_icon_name, PATHINFO_EXTENSION));

                // Batasi jenis file yang diizinkan
                $allowed_icon_exts = array('png', 'jpg', 'jpeg');

                // Periksa apakah ekstensi file icon valid
                if (in_array($file_icon_ext, $allowed_icon_exts)) {
                    // Pindahkan file icon ke direktori tujuan
                    $upload_icon_dir = '../assets/icon/rencana/';
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
                } else {
                    echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Jenis file icon tidak valid!',
                            showConfirmButton: true,
                        });
                    </script>";
                }
            }

            // Memasukkan data ke tabel rencana
            $query = "INSERT INTO rencana (nama_rencana, file_json, icon, icon_id, checkbox_id, id_jenis_file) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssssss', $nama_rencana, $file_name, $icon, $icon_id, $checkbox_id, $id_jenis_file);

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
                            window.location.href = 'daftar-rencana';
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
        <div class="w-75 content align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4 mb-5" action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Input data rencana</h2>
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama_rencana" class="form-label orange ps-1 pe-1">Nama data</label>
                    <input type="text" name="nama_rencana" class="form-control p-2" id="nama_rencana" placeholder="Masukkan nama data" required />
                </div>
                <!-- File GeoJSON -->
                <div class=" mb-3">
                    <label for="file_json" class="form-label orange ps-1 pe-1">File GeoJSON</label>
                    <input type="file" class="form-control p-2" id="file_json" name="file_json" accept=".geojson" required />
                </div>
                <!-- Jenis file -->
                <div class="mb-3">
                    <label for="id_jenis_file" class="form-label orange ps-1 pe-1">Jenis file</label>
                    <select name="id_jenis_file" id="id_jenis_file" class="form-select form-control p-2" required>
                        <option selected disabled>Pilih jenis file</option>
                        <?php foreach ($getjenisfile as $a) : ?>
                            <option value="<?= $a['jenis_file_id']; ?>"><?= $a['nama_jenis']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- ICON -->
                <div class=" mb-3" id="icon_section" style="display:none;">
                    <label for="icon" class="form-label orange ps-1 pe-1">File Icon</label>
                    <input type="file" class="form-control p-2" id="icon" name="icon" accept=".jpg, .jpeg, .png" />
                </div>
                <!-- icon id -->
                <div class=" mb-3" id="icon_id_section" style="display:none;">
                    <label for="icon_id" class="form-label orange ps-1 pe-1">Icon ID</label>
                    <input type="text" name="icon_id" class="form-control p-2" id="icon_id" placeholder="*Wajib di isi untuk pembuatan icon" />
                    <p class="text-danger ms-3"><small>Contoh : IconRencanaA</small></p>
                </div>

                <!-- Checkbox id -->
                <div class=" mb-3">
                    <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox ID</label>
                    <input type="text" name="checkbox_id" class="form-control p-2" id="checkbox_id" placeholder="*Wajib di isi untuk pembuatan checkbox" required />
                    <p class="text-danger ms-3"><small>Contoh : RencanaACheckbox</small></p>
                </div>
                <div class="btn-kirim d-flex justify-content-end mt-5 p-4">
                    <button type="submit" name="send" class="btn btn-primary w-25 p-2">
                        <i class="fa-solid fa-paper-plane"></i> Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showHideColumns() {
        var selectedJenisFile = document.getElementById("id_jenis_file").value;
        var iconSection = document.getElementById("icon_section");
        var iconIdSection = document.getElementById("icon_id_section");

        // Jika jenis file adalah "marker" (ID 1), tampilkan kolom ICON dan icon_id
        if (selectedJenisFile == 1) {
            iconSection.style.display = "block";
            iconIdSection.style.display = "block";
        } else {
            // Jika jenis file bukan "marker" atau memiliki ID selain 1, sembunyikan kolom ICON dan icon_id
            iconSection.style.display = "none";
            iconIdSection.style.display = "none";
        }
    }

    // Panggil fungsi showHideColumns saat jenis file dipilih berubah
    document.getElementById("id_jenis_file").addEventListener("change", showHideColumns);

    // Panggil fungsi showHideColumns saat halaman pertama kali dimuat untuk menyesuaikan tampilan berdasarkan nilai awal dropdown
    showHideColumns();
</script>

<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>