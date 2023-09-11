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
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div>
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="d-flex flex-column">
                <div class="p-5">
                    <?php foreach ($getdata as $a) : ?>
                        <img src="../assets/struktur/<?= $a['file']; ?>" class="img-fluid p-5 bg-body-tertiary rounded-4 border border-dark">
                    <?php endforeach; ?>
                </div>
                <div class="formulir">
                    <form action="" method="post" class="w-50 m-auto p-4 bg-secondary-subtle rounded-2 border border-dark" enctype="multipart/form-data">
                        <h5 class="text-center mb-3">Update file struktur</h5>
                        <div class="mb-3">
                            <input type="file" name="file" class="form-control p-2" id="file" accept=".png, .jpg">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-3 py-1">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fileName = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];

    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/struktur/';
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $filePath)) {
            $conn = koneksi();

            if ($conn) {
                $sql = "UPDATE struktur_organisasi SET file = ? WHERE id = 1";
                $stmt = $conn->prepare($sql);

                if ($stmt) {
                    $stmt->bind_param("s", $fileName);

                    if ($stmt->execute()) {
                        echo "<script>
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'File berhasil diunggah dan data diubah.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 4000
                            }).then(function() {
                                 window.location.href = 'struktur-organisasi'; 
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Gagal mengubah data. Error: " . $conn->error . "',
                                icon: 'error'
                            }).then(function() {
                                window.location.href = 'struktur-organisasi'; 
                            });
                        </script>";
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengunggah file. Kode error: " . $_FILES['file']['error'] . "',
                            icon: 'error'
                        });
                    </script>";
                }
            }
        }
    }
}

?>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>