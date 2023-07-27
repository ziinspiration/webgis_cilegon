<?php include 'views/partials/starter-head.php'; ?>
<style>
    * {
        font-family: montserrat;
    }

    body {
        background-image: url(../assets/index/footer2.jpg);
    }

    th {
        padding: 10px !important;
    }

    td {
        padding: 10px !important;
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

        .btn-primary {
            width: 100% !important;
        }

    }

    .row {
        margin-top: 100px !important;
        margin-bottom: 100px !important;
    }

    .alamat,
    .email,
    .telphone {
        color: orange;
    }

    .iFunction {
        cursor: pointer;
        transition: color 0.3s ease;
        color: grey;
        font-size: 20px !important;
        margin-top: 6px !important;
        padding-left: 10px !important;
    }

    .iFunction:hover {
        color: orange;
        transform: scale(1.1);
    }

    .form-tambah {
        height: 300px;
    }

    /* Tambahkan gaya khusus untuk tombol Add */
    .btn-add {
        margin-bottom: 10px;
    }

    /* Gaya untuk mengatur tinggi textarea saat mode tambah data */
    .form-tambah textarea {
        height: 100px;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <form action="" method="post" class="w-75 bg-dark rounded-2">
            <table class="table table-dark table-striped rounded-2" id="data-table">
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
                                <textarea class="form-control" name="informasi" id="input-marque-<?= $marque['id']; ?>" data-id="<?= $marque['id']; ?>" data-type="marquee" readonly aria-describedby="<?= $marque['nama_data']; ?>"><?= $marque['informasi']; ?></textarea>
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
            <button type="button" class="btn btn-primary p-2 btn-add mt-4 ms-3 mb-4" onclick="addRow()"><i class="fa-solid fa-plus"></i> Add</button>
        </form>
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
                });
            },
            error: function(xhr, status, error) {
                alert("Terjadi kesalahan saat menyimpan perubahan: " + xhr.status + " " + error);
            }
        });
    }

    function deleteData(id, type) {
        Swal.fire({
            title: 'Apakah kamu yakin?',
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

    function addRow() {
        var table = document.getElementById("data-table").getElementsByTagName('tbody')[0];
        var newRow = table.insertRow(table.rows.length);

        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);

        cell1.innerHTML = '<input type="text" class="form-control" name="new_nama_data[]">';
        cell2.innerHTML =
            '<textarea class="form-control form-tambah" name="new_informasi[]" data-type="marquee"></textarea>';
        cell3.innerHTML =
            '<i class="fa-solid fa-floppy-disk iFunction" onclick="saveNewData(this)"></i>';
    }

    function saveNewData(element) {
        var textarea = element.parentNode.parentNode.querySelector('textarea');
        var informasi = textarea.value;
        var inputNamaData = element.parentNode.parentNode.querySelector('input[name="new_nama_data[]"]');
        var namaData = inputNamaData.value;

        $.ajax({
            url: "ajax/save-new-marque.php",
            type: "POST",
            data: {
                informasi: informasi
            },
            success: function(response) {
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: 'Selamat :)',
                    text: 'Data baru berhasil ditambahkan',
                    footer: 'Sukses',
                    showConfirmButton: false,
                    timer: 3500
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal menambahkan data baru.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500,
                });
            }
        });
    }

    function deleteRow(element) {
        var row = element.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>
<?php include 'views/partials/starter-foot.php'; ?>