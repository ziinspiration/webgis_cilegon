<?php include 'views/partials/starter-head.php'; ?>
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
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 content align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="post" enctype="multipart/form-data">
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