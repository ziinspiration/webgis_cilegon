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
    .right,
    .center {
        width: 100% !important;
        margin: 0 !important;
    }

    .note {
        font-size: 11px !important;
        margin-top: 5px !important;
    }

    .btn-primary {
        width: 50% !important;
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
    // Mendapatkan data dari form
    $nama_prasarana = htmlspecialchars($_POST['nama_prasarana']);
    $id_jenis_file = $_POST['id_jenis'];
    $id_jenis_prasarana = $_POST['id_jenis_prasarana'];

    // Atur nilai icon dan icon_id menjadi 0 jika jenis file adalah "marker" (ID 1)
    $icon = ($id_jenis_file == 1 && isset($_POST['icon'])) ? htmlspecialchars($_POST['icon']) : '0';
    $icon_id = ($id_jenis_file == 1) ? htmlspecialchars($_POST['icon_id']) : '0';

    $checkbox_id = htmlspecialchars($_POST['checkbox_id']);

    // Cek apakah file JSON telah diunggah
    if (isset($_FILES['file_json']) && $_FILES['file_json']['error'] === UPLOAD_ERR_OK) {
        // Mendapatkan informasi file JSON
        $file_name = $_FILES['file_json']['name'];
        $file_tmp = $_FILES['file_json']['tmp_name'];

        // Cek apakah nama_prasarana sudah ada dalam database
        $query_check_nama_prasarana = "SELECT COUNT(*) FROM prasarana WHERE nama_prasarana = ?";
        $stmt_check_nama_prasarana = mysqli_prepare($conn, $query_check_nama_prasarana);
        mysqli_stmt_bind_param($stmt_check_nama_prasarana, 's', $nama_prasarana);
        mysqli_stmt_execute($stmt_check_nama_prasarana);
        mysqli_stmt_bind_result($stmt_check_nama_prasarana, $nama_prasarana_count);
        mysqli_stmt_fetch($stmt_check_nama_prasarana);
        mysqli_stmt_close($stmt_check_nama_prasarana);

        if ($nama_prasarana_count > 0) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengirim data!',
                    text: 'Nama data sudah ada dalam database.',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'daftar-prasarana';
                    }
                });
            </script>";
            exit;
        }

        // Cek apakah checkbox_id sudah ada dalam database
        $query_check_checkbox_id = "SELECT COUNT(*) FROM prasarana WHERE checkbox_id = ?";
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
                        window.location.href = 'daftar-prasarana';
                    }
                });
            </script>";
            exit;
        }

        // Pindahkan file JSON ke direktori tujuan
        $upload_dir = '../assets/geojson/prasarana/';
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
                    $upload_icon_dir = '../assets/icon/prasarana/';
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

            // Memasukkan data ke tabel prasarana
            $query = "INSERT INTO prasarana (nama_prasarana, file_json, icon, icon_id, checkbox_id, id_jenis_prasarana, id_jenis) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ssssssi', $nama_prasarana, $file_name, $icon, $icon_id, $checkbox_id, $id_jenis_prasarana, $id_jenis_file);

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
                            window.location.href = 'daftar-prasarana';
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
                <h2 class="text-center text-light mb-5 mt-2">Input data prasarana</h2>
                <div class="formulir d-flex flex-column justify-content-between">
                    <div class="left w-100 me-3">
                        <!-- Nama -->
                        <div class="mb-3 kolom">
                            <label for="nama_prasarana" class="form-label orange ps-1 pe-1">Nama data</label>
                            <input type="text" name="nama_prasarana" class="form-control p-2" id="nama_prasarana"
                                placeholder="Masukkan nama data" required />
                        </div>
                        <!-- File -->
                        <div class="mb-3 kolom">
                            <label for="file_json " class="form-label orange ps-1 pe-1">File GeoJSON</label>
                            <input type="file" class="form-control p-2" id="file_json" name="file_json"
                                accept=".geojson" required />
                        </div>
                    </div>
                    <div class="center w-100">
                        <!-- Kategori -->
                        <div class="mb-3">
                            <label for="id_jenis" class="form-label orange ps-1 pe-1">Jenis file</label>
                            <select name="id_jenis" id="id_jenis" class="form-select form-control p-2" required>
                                <option selected disabled>Pilih jenis file</option>
                                <?php foreach ($getjenisfile as $a) : ?>
                                <option value="<?= $a['jenis_file_id']; ?>"><?= $a['nama_jenis']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Icon file -->
                        <div class=" mb-3" id="icon_section" style="display:none;">
                            <label for="icon" class="form-label orange ps-1 pe-1">File Icon</label>
                            <input type="file" class="form-control p-2" id="icon" name="icon"
                                accept=".jpg, .jpeg, .png" />
                        </div>
                        <!-- Icon id -->
                        <div class=" mb-3" id="icon_id_section" style="display:none;">
                            <label for="icon_id" class="form-label orange ps-1 pe-1">Icon ID</label>
                            <input type="text" name="icon_id" class="form-control p-2" id="icon_id"
                                placeholder="*Wajib di isi untuk pembuatan icon" />
                            <p class="text-danger ms-3"><small>Contoh : IconRencanaA</small></p>
                        </div>
                        <!-- Checkbox id -->
                        <div class="right w-100">
                            <div class=" mb-3 kolom">
                                <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox</label>
                                <input type="text" name="checkbox_id" class="form-control p-2" id="checkbox_id"
                                    placeholder="*Wajib di isi untuk pembuatan checkbox" required />
                                <p class="text-danger note"><small>Contoh : JaringanJalanCheckbox</small></p>
                            </div>
                            <!-- Jenis file -->
                            <div class="mb-3 kolom">
                                <label for="id_jenis_prasarana" class="form-label orange ps-1 pe-1">Jenis
                                    prasarana</label>
                                <select name="id_jenis_prasarana" id="id_jenis_prasarana"
                                    class="form-select form-control p-2" required>
                                    <option selected disabled>Pilih jenis prasarana</option>
                                    <?php foreach ($getjenisprasarana as $a) : ?>
                                    <option value="<?= $a['id_jenis']; ?>"><?= $a['nama_jenis']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="btn-kirim d-flex justify-content-end">
                        <button type="submit" name="send" class="btn btn-primary w-25 p-2 mt-4"><i
                                class="fa-solid fa-paper-plane"></i> Kirim</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php'; ?>
<script>
function showHideColumns() {
    var selectedJenisFile = document.getElementById("id_jenis").value;
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
document.getElementById("id_jenis").addEventListener("change", showHideColumns);

// Panggil fungsi showHideColumns saat halaman pertama kali dimuat untuk menyesuaikan tampilan berdasarkan nilai awal dropdown
showHideColumns();
</script>
<?php include 'views/partials/starter-foot.php'; ?>