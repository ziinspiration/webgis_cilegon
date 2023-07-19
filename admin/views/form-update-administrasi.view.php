<?php include 'views/partials/starter-head.php' ?>

<div class="container-fluid">
    <div class="row">
        <form class="form p-5 m-auto" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />

            <div class="mb-3">
                <label for="nama_adm" class="form-label">Nama data</label>
                <input type="text" class="form-control" id="nama_adm" name="nama_adm" value="<?= $getdata['nama_adm']; ?>" required />
            </div>

            <div class="mb-3">
                <div class="file-now">
                    <?php if (!empty($getdata['file_json'])) : ?>
                        <p><?= basename($getdata['file_json']); ?></p>
                    <?php endif; ?>
                </div>
                <label for="file_json" class="form-label">File geojson</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="file_json" name="file_json" accept=".geojson" />
                    <label class="input-group-text" for="file_json">Pilih file</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="checkbox_id" class="form-label">Checkbox ID</label>
                <input type="text" class="form-control" id="checkbox_id" name="checkbox_id" value="<?= $getdata['checkbox_id']; ?>" required />
            </div>

            <button type="submit" name="submit" class="btn btn-primary mt-3 mb-2"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
        </form>
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