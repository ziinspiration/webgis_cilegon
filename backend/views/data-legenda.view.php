<?php include 'views/partials/starter-head.php' ?>
<?php include 'views/partials/alert-tambah-data.php'; ?>
<style>
@media screen and (max-width: 900px) {
    .content {
        flex-direction: column !important;
    }

    .child-content {
        margin: 20px !important;
    }
}

.content {
    font-family: Montserrat;
}

th {
    padding: 10px !important;
}

td {
    padding: 10px !important;
}
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div>
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="content d-flex flex-column">
                <div class="top mb-5">
                    <form action="" method="post" enctype="multipart/form-data"
                        class="bg-secondary-subtle p-4 rounded-2">
                        <div class="mb-3">
                            <label for="nama_data" class="form-label ms-1">Nama Data</label>
                            <input type="text" name="nama_data" class="form-control p-2" id="nama_data" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label ms-1">File <small class="text-danger">*(hanya
                                    PNG)</small></label>
                            <input type="file" name="file" accept=".png" class="form-control p-2" id="file" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_id" class="form-label ms-1">Jenis Legenda</label>
                            <select name="jenis_id" id="jenis_id" class="form-select form-control p-2" required>
                                <option selected disabled>Pilih Jenis Legenda</option>
                                <?php foreach ($getdata as $a) : ?>
                                <option value="<?= $a['id_jenis']; ?>"><?= $a['jenis_data_legenda']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-2 py-1">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="bottom mt-5">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Data</th>
                                <th scope="col w-25">File</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getlegenda as $a) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $a['nama_data']; ?></td>
                                <td class="w-25"><img src="../assets/legenda/<?= $a['file']; ?>" class="w-25" alt="">
                                </td>
                                <td><?= $a['jenis_data_legenda']; ?></td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" class="hapusData" data-id-legenda="<?= $a["id"] ?>">
                                        <span class="badge text-bg-danger p-2"><i class="fa-solid fa-trash"></i>
                                            Hapus</span>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_data = $_POST["nama_data"];
    $jenis_id = $_POST["jenis_id"];

    // Cek apakah file yang diunggah adalah tipe PNG
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

    if (strtolower($file_extension) != "png") {
        // Tampilkan SweetAlert untuk notifikasi kesalahan
        echo '<script type="text/javascript">
                Swal.fire({
                    position: "center-center",
                    icon: "error",
                    title: "Oops :(",
                    text: "Hanya file PNG yang diperbolehkan!",
                    showConfirmButton: false,
                    timer: 3500
                });
              </script>';
    } else {
        // Upload file ke direktori yang ditentukan
        $upload_dir = "../assets/legenda/";
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $file_path)) {
            // Masukkan data ke tabel legenda
            $sql = "INSERT INTO legenda (nama_data, file, jenis_id) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $nama_data, $file_name, $jenis_id);

            if ($stmt->execute()) {
                // Tampilkan SweetAlert untuk notifikasi berhasil
                echo '<script type="text/javascript">
                        Swal.fire({
                            position: "center-center",
                            icon: "success",
                            title: "Sukses!",
                            text: "Data berhasil disimpan.",
                            showConfirmButton: false,
                            timer: 3500
                        });
                        setTimeout(function(){
                            window.location.href = "data-legenda";
                        }, 3500);
                      </script>';
            } else {
                // Tampilkan SweetAlert untuk notifikasi kesalahan
                echo '<script type="text/javascript">
                        Swal.fire({
                            position: "center-center",
                            icon: "error",
                            title: "Oops :(",
                            text: "Gagal menyimpan data: ' . $conn->error . '",
                            showConfirmButton: false,
                            timer: 3500
                        });
                      </script>';
            }

            $stmt->close();
        } else {
            // Tampilkan SweetAlert jika gagal mengunggah file
            echo '<script type="text/javascript">
                    Swal.fire({
                        position: "center-center",
                        icon: "error",
                        title: "Oops :(",
                        text: "Gagal mengunggah file!",
                        showConfirmButton: false,
                        timer: 3500
                    });
                  </script>';
        }
    }

    $conn->close();
}
?>
<?php include 'views/partials/script.php' ?>
<script>
const hapusButtons = document.getElementsByClassName('hapusData');
for (let i = 0; i < hapusButtons.length; i++) {
    hapusButtons[i].addEventListener('click', function(event) {
        event.preventDefault();

        // Use SweetAlert for the confirmation dialog
        Swal.fire({
            title: 'Apakah Anda yakin ingin menghapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak',
            didOpen: () => {
                const sweetAlertContainer = document.querySelector('.swal2-popup');
                if (sweetAlertContainer) {
                    sweetAlertContainer.style.padding = '20px'; // Atur padding sesuai kebutuhan
                    const sweetAlertIcon = sweetAlertContainer.querySelector('.swal2-icon');
                    if (sweetAlertIcon) {
                        sweetAlertIcon.style.marginBottom = '15px'; // Atur margin sesuai kebutuhan
                    }
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const idLegenda = hapusButtons[i].getAttribute('data-id-legenda');
                console.log("Data dengan ID " + idLegenda + " telah dihapus!");

                // Perform deletion action (e.g., delete data from the server)
                window.location.href = "functions/delete-legenda.php?id=" + idLegenda;
            } else {
                console.log("Penghapusan dibatalkan.");
            }
        });
    });
}
</script>

<?php include 'views/partials/starter-foot.php' ?>