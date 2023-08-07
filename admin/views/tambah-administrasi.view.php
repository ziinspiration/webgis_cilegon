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
    margin-bottom: 100px !important;
}
</style>
<?php
if (isset($_POST['send'])) {
    // Mendapatkan data dari form
    $nama_adm = htmlspecialchars($_POST['nama_adm']);
    $checkbox_id = htmlspecialchars($_POST['checkbox_id']);

    // Cek apakah file telah diunggah
    if (isset($_FILES['file_json']) && $_FILES['file_json']['error'] === UPLOAD_ERR_OK) {
        // Mendapatkan informasi file
        $file_name = $_FILES['file_json']['name'];
        $file_tmp = $_FILES['file_json']['tmp_name'];
        $file_type = $_FILES['file_json']['type'];

        // Cek apakah nama_adm sudah ada dalam database
        $query_check_nama_adm = "SELECT COUNT(*) FROM administrasi WHERE nama_adm = ?";
        $stmt_check_nama_adm = mysqli_prepare($conn, $query_check_nama_adm);
        mysqli_stmt_bind_param($stmt_check_nama_adm, 's', $nama_adm);
        mysqli_stmt_execute($stmt_check_nama_adm);
        mysqli_stmt_bind_result($stmt_check_nama_adm, $nama_adm_count);
        mysqli_stmt_fetch($stmt_check_nama_adm);
        mysqli_stmt_close($stmt_check_nama_adm);

        if ($nama_adm_count > 0) {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengirim data!',
                    text: 'Nama data sudah ada dalam database.',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'daftar-administrasi';
                    }
                });
            </script>";
            exit;
        }

        // Cek apakah checkbox_id sudah ada dalam database
        $query_check_checkbox_id = "SELECT COUNT(*) FROM administrasi WHERE checkbox_id = ?";
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
                        window.location.href = 'daftar-administrasi';
                    }
                });
            </script>";
            exit;
        }

        // Pindahkan file ke direktori tujuan
        $upload_dir = '../assets/geojson/administrasi/';
        $upload_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $upload_path)) {
            // Memasukkan data ke tabel administrasi
            $query = "INSERT INTO administrasi (nama_adm, file_json, checkbox_id) VALUES (?, ?, ?)";

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'sss', $nama_adm, $file_name, $checkbox_id);

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
                            window.location.href = 'daftar-administrasi';
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
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'daftar-administrasi';
                        }
                    });
                </script>";
            }
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal mengunggah file!',
                    text: 'Terjadi kesalahan saat mengunggah file GeoJSON.',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'daftar-administrasi';
                    }
                });
            </script>";
        }
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Pilih file GeoJSON!',
                text: 'Mohon pilih file GeoJSON yang valid.',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'daftar-administrasi';
                }
            });
        </script>";
    }
    echo "<script>window.location.href = 'daftar-administrasi';</script>"; // Redirect kembali
    exit;
}
?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Input data administrasi</h2>
                <div class="formulir d-flex justify-content-between">
                    <div class="left w-50 me-3">
                        <!-- Nama -->
                        <div class="mb-3 kolom">
                            <label for="nama_adm" class="form-label orange ps-1 pe-1">Nama data</label>
                            <input type="text" name="nama_adm" class="form-control p-2" id="nama_adm"
                                placeholder="Masukkan nama data" required />
                        </div>
                        <!-- File -->
                        <div class="mb-3 kolom">
                            <label for="file_json" class="form-label orange ps-1 pe-1">File GeoJSON</label>
                            <input type="file" class="form-control p-2" id="file_json" name="file_json"
                                accept=".geojson" required />
                        </div>
                    </div>
                    <!-- Checkbox id -->
                    <div class="right w-50 ms-3 ">
                        <div class="mb-3 kolom">
                            <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox</label>
                            <input type="text" name="checkbox_id" class="form-control p-2" id="checkbox_id"
                                placeholder="*Wajib di isi untuk pembuatan checkbox" required />
                            <p class="text-danger note"><small>Contoh : BatasAdministrasiCheckbox</small></p>
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
<?php include 'views/partials/starter-foot.php'; ?>