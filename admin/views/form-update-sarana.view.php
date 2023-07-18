<?php include 'views/partials/starter-head.php' ?>

<div class="container-fluid">
    <div class="row">
        <form class="form p-5 m-auto" action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $getdata['id']; ?>" />

            <div class="mb-3">
                <label for="nama_sarana" class="form-label">Nama data</label>
                <input type="text" class="form-control" id="nama_sarana" name="nama_sarana"
                    value="<?= $getdata['nama_sarana']; ?>" required />
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

            <img class="img-preview w-25" src="../assets/icon/<?= $getdata["icon"]; ?>" alt="Preview" id="preview"
                class="preview-image" />
            <div class="mb-3 mt-4">
                <label for="icon" class="form-label">ICON</label>
                <input type="file" onchange="previewImage(event)" class="form-control" id="icon" name="icon"
                    accept=".jpg, .jpeg, .png" />
            </div>

            <div class="mb-3">
                <label for="icon_id" class="form-label">icon_id</label>
                <input type="text" class="form-control" id="icon_id" name="icon_id" value="<?= $getdata['icon_id']; ?>"
                    required />
            </div>

            <div class="mb-3">
                <label for="checkbox_id" class="form-label">Checkbox ID</label>
                <input type="text" class="form-control" id="checkbox_id" name="checkbox_id"
                    value="<?= $getdata['checkbox_id']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control mb-1 w-25" id="kategoriInput" name="kategori"
                    value="<?= $getdata['kategori']; ?>" required />
                <select name="kategoriSelect" id="kategoriSelect" class="form-select form-control"
                    aria-label="Default select example" onchange="changeKategori()">
                    <option selected disabled>Pilih jenis kategori</option>
                    <option value="Kantor">Kantor</option>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Pendidikan">pendidikan</option>
                    <option value="Pariwisata">Pariwisata</option>
                    <option value="Transportasi">Transportasi</option>
                    <option value="Peribadatan">Peribadatan</option>
                    <option value="Fasilitas umum">Fasilitas umum</option>
                </select>
            </div>

            <button type="submit" name="submit" class="btn btn-primary mt-3 mb-2"><i
                    class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
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

function changeKategori() {
    var select = document.getElementById("kategoriSelect");
    var input = document.getElementById("kategoriInput");
    var selectedValue = select.value;
    input.value = selectedValue;
}
</script>

<?php
if (isset($_POST["submit"])) {
    // ambil data dari form
    $id = $_POST["id"];
    $nama_sarana = $_POST["nama_sarana"];
    $icon_id = $_POST["icon_id"];
    $checkbox_id = $_POST["checkbox_id"];
    $kategori = $_POST["kategori"];

    // query update data sarana
    $query = "UPDATE sarana SET
            nama_sarana = '$nama_sarana',
            checkbox_id = '$checkbox_id',
            icon_id = '$icon_id',
            kategori = '$kategori'";

    // cek apakah ada file yang diupload
    if (!empty($_FILES['file_json']['name'])) {
        // Proses upload file
        $file_name = $_FILES["file_json"]["name"];
        $file_tmp = $_FILES["file_json"]["tmp_name"];
        $file_error = $_FILES["file_json"]["error"];

        // Cek apakah file berhasil diupload dan tidak ada error
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
                alert('Terjadi kesalahan saat upload file!');
                document.location.href = 'ubah-sarana.php';
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

        // Cek apakah file icon berhasil diupload dan tidak ada error
        if ($icon_error === UPLOAD_ERR_OK) {
            $icon_destination = '../assets/icon/' . $icon_name;

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
                    alert('Ekstensi file icon tidak valid. Harap pilih file dengan ekstensi JPG, JPEG, atau PNG.');
                    document.location.href = 'ubah-sarana.php';
                   </script>
                ";
                exit;
            }
        } else {
            // Error saat upload file icon
            echo "
               <script>
                alert('Terjadi kesalahan saat upload file icon!');
                document.location.href = 'ubah-sarana.php';
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
            document.location.href = 'ubah-sarana.php';
           </script>
        ";
    } else {
        echo "
           <script>
            alert('Data gagal diupdate!');
            document.location.href = 'ubah-sarana.php';
           </script>
        ";
    }
}
?>

<?php include 'views/partials/starter-foot.php' ?>