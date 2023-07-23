<?php include 'views/partials/starter-head.php'; ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama_rencana" class="form-label orange ps-1 pe-1">Nama data</label>
                    <input type="text" name="nama_rencana" class="form-control" id="nama_rencana" placeholder="Masukkan nama data" />
                </div>
                <!-- File GeoJSON -->
                <div class=" mb-3">
                    <label for="file_json" class="form-label orange ps-1 pe-1">File GeoJSON</label>
                    <input type="file" class="form-control" id="file_json" name="file_json" accept=".geojson" />
                </div>
                <!-- Jenis file -->
                <div class="mb-3">
                    <label for="id_jenis_file" class="form-label">Jenis file</label>
                    <select name="id_jenis_file" id="id_jenis_file" class="form-select form-control">
                        <option selected disabled>Pilih jenis file</option>
                        <?php foreach ($getjenisfile as $a) : ?>
                            <option value="<?= $a['id']; ?>"><?= $a['nama_jenis']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- ICON -->
                <div class=" mb-3" id="icon_section" style="display:none;">
                    <label for="icon" class="form-label orange ps-1 pe-1">File Icon</label>
                    <input type="file" class="form-control" id="icon" name="icon" accept=".jpg, .jpeg, .png" />
                </div>
                <!-- icon id -->
                <div class=" mb-3" id="icon_id_section" style="display:none;">
                    <label for="icon_id" class="form-label orange ps-1 pe-1">Icon ID</label>
                    <input type="text" name="icon_id" class="form-control" id="icon_id" placeholder="*Wajib di isi untuk pembuatan icon" />
                </div>

                <!-- Checkbox id -->
                <div class=" mb-3">
                    <label for="checkbox_id" class="form-label orange ps-1 pe-1">Checkbox ID</label>
                    <input type="text" name="checkbox_id" class="form-control" id="checkbox_id" placeholder="*Wajib di isi untuk pembuatan checkbox" />
                </div>
                <button type="submit" name="send" class="btn btn-primary m-auto w-50 p-2">
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan atau menyembunyikan kolom ICON dan icon_id berdasarkan pilihan jenis file
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