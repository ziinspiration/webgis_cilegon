<?php include 'views/partials/starter-head.php'; ?>
<style>
    th {
        padding: 10px !important;
    }

    td {
        padding: 10px !important;
    }


    i.iFunction {
        cursor: pointer !important;
    }

    i.iFunction:hover {
        color: orange !important;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <!-- Tambah data -->
            <form action="" method="post" class="mb-3">
                <div class="add-marquee">
                    <ul class="list-unstyled">
                        <li>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="tambahMarque">@</span>
                                <input type="text" class="form-control" name="nama_data" placeholder="Masukkan nama data" aria-label="Masukkan nama data" aria-describedby="tambahMarque">
                            </div>
                        </li>
                        <li>
                            <div class="input-group">
                                <span class="input-group-text">Isi informasi</span>
                                <textarea class="form-control" name="informasi" aria-label="With textarea"></textarea>
                            </div>
                        </li>
                        <li>
                            <input type="hidden" name="jenis_informasi" id="" value="marquee">
                        </li>
                    </ul>
                    <button class="btn btn-primary p-1" type="submit" name="kirim_marque"><i class="fa-solid fa-paper-plane"></i> Kirim</button>
                </div>
            </form>

            <!-- Update data -->
            <form action="" method="post">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Data</th>
                            <th>Informasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getmarquee as $marque) : ?>
                            <tr>
                                <td><?= $marque['nama_data']; ?></td>
                                <td>
                                    <textarea class="form-control" name="informasi" id="input-marque-<?= $marque['id']; ?>" data-id="<?= $marque['id']; ?>" data-type="marque" readonly aria-describedby="<?= $marque['nama_data']; ?>"><?= $marque['informasi']; ?></textarea>
                                </td>
                                <td>
                                    <i class="fa-regular fa-pen-to-square iFunction" onclick="enableEdit('input-marque-<?= $marque['id']; ?>')"></i>
                                    <i class="fa-solid fa-floppy-disk iFunction" onclick="saveChanges('<?= $marque['id']; ?>', 'marque')"></i>
                                    <i class="fa-solid fa-trash iFunction" onclick="deleteData('<?= $marque['id']; ?>', 'marque')"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script>
    function moveCursorToEnd(input) {
        input.focus();
        input.setSelectionRange(input.value.length, input.value.length);
    }

    function enableEdit(id) {
        var inputField = document.getElementById(id);
        inputField.removeAttribute("readonly");
        inputField.focus();
    }

    function saveChanges(id, type) {
        var informasi = document.getElementById(`input-${type}-${id}`).value;

        $.ajax({
            url: "ajax/update-informasi.php",
            type: "POST",
            data: {
                id: id,
                type: type,
                informasi: informasi
            },
            success: function(response) {
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: 'Selamat :)',
                    text: 'Perubahan anda berhasil tersimpan',
                    footer: 'Sukses',
                    showConfirmButton: false,
                    timer: 3500
                })

            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan saat menyimpan perubahan: " + xhr.status + " " + error);
            }
        });
    }

    // Delete running text
    function deleteData(id, type) {
        Swal.fire({
            title: 'Apakah kamu yakin ?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/delete-marquee.php",
                    type: "POST",
                    data: {
                        id: id,
                        type: type,
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Terhapus!',
                            text: 'Data telah dihapus.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal menghapus data.',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                });
            }
        });
    }
</script>
<?php include 'views/partials/starter-foot.php'; ?>