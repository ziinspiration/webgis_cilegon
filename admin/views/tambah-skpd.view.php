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
    // Mendapatkan data dari form dan lakukan pembersihan dengan clean_input
    $nama_dinas = clean_input($_POST['nama_dinas']);
    $alamat = clean_input($_POST['alamat']);

    // Prepare statement
    $query = "INSERT INTO skpd (nama_dinas, alamat) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $nama_dinas, $alamat);

    // Menjalankan query
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        // Success alert using SweetAlert
        $successMessage = "Data berhasil ditambahkan ke tabel skpd";
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data berhasil ditambahkan',
                    text: '$successMessage',
                }).then(function() {
                    window.location.href = 'daftar-data-skpd';
                });
            </script>
        ";
        exit;
    } else {
        // Error alert using SweetAlert
        $errorMessage = "Terjadi kesalahan: " . mysqli_error($conn);
        echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '$errorMessage',
                });
            </script>
        ";
    }
}

// Menutup koneksi database
mysqli_close($conn);
?>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 content align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="post" enctype="multipart/form-data">
                <h2 class="text-center text-light mb-5 mt-2">Input data SKPD</h2>
                <!-- Nama Dinas -->
                <div class="mb-3">
                    <label for="nama_dinas" class="form-label orange ps-1 pe-1">Nama Dinas</label>
                    <input type="text" name="nama_dinas" class="form-control p-2" id="nama_dinas"
                        placeholder="Masukkan nama dinas" required />
                </div>
                <!-- Alamat -->
                <div class=" mb-3">
                    <label for="alamat" class="form-label orange ps-1 pe-1">Alamat</label>
                    <input type="text" name="alamat" class="form-control p-2" id="alamat"
                        placeholder="Masukkan alamat dinas" required />
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
<?php include 'views/partials/script.php'; ?>
<?php include 'views/partials/starter-foot.php'; ?>