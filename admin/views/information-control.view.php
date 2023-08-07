<?php include 'views/partials/starter-head.php'; ?>
<?php include 'views/partials/alert-tambah-data.php'; ?>
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

    .btn-add {
        margin-bottom: 10px;
    }

    .form-tambah textarea {
        height: 100px;
    }

    .nama-data-baru {
        height: 50px !important;
        width: 35% !important;
    }

    @media screen and (max-width:990px) {
        .nama-data-baru {
            width: 70% !important;
        }
    }
</style>
<?php
if (isset($_POST['send'])) {
    $nama_data = clean_input($_POST['nama_data']);
    $informasi = clean_input($_POST['informasi']);
    $jenis_informasi = clean_input($_POST['jenis_informasi']);

    $query = "INSERT INTO informasi_bappeda (nama_data, informasi, jenis_informasi) VALUES ('$nama_data', '$informasi', '$jenis_informasi')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            Swal.fire({
                title: 'Sukses!',
                text: 'Data berhasil ditambahkan.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(function() {
                window.location = 'information-control';
            });
        </script>";
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <form action="" method="post" class="w-75 bg-dark rounded-2">
            <table class="table table-dark table-striped rounded-2 mb-5" id="data-table">
                <thead>
                    <tr class="text-center">
                        <th>Nama Data</th>
                        <th>Informasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getmarquee as $marque) : ?>
                        <tr class="text-center">
                            <td class="p-3"><?= $marque['nama_data']; ?></td>
                            <td>
                                <textarea class="form-control p-2" name="informasi" id="input-marque-<?= $marque['id']; ?>" data-id="<?= $marque['id']; ?>" data-type="marquee" readonly aria-describedby="<?= $marque['nama_data']; ?>"><?= $marque['informasi']; ?></textarea>
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
            <form class="mt-5" action="" method="post">
                <h4 class="text-center orange mb-3">Tambah informasi</h4>
                <div class="p-3">
                    <input type="text" class="form-control nama-data-baru p-3 mb-2" name="nama_data" placeholder="Masukkan nama informasi disini">
                    <textarea class="form-control form-tambah p-3" name="informasi" placeholder="Masukkan isi informasi disini"></textarea>
                    <input type="hidden" name="jenis_informasi" value="marquee">
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" name="send" class="btn btn-primary p-2 btn-add mt-3 me-3 mb-4">
                        Tambahkan
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </form>
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

    // function addRow() {
    //     var table = document.getElementById("data-table").getElementsByTagName('tbody')[0];
    //     var newRow = table.insertRow(table.rows.length);

    //     var cell1 = newRow.insertCell(0);
    //     var cell2 = newRow.insertCell(1);
    //     var cell3 = newRow.insertCell(2);

    //     cell1.innerHTML = '<input type="text" class="form-control" name="nama_data">';
    //     cell2.innerHTML =
    //         '<textarea class="form-control form-tambah" name="new_informasi[]" data-type="marquee"></textarea>';
    //     cell3.innerHTML =
    //         '<i class="fa-solid fa-plus iFunction" onclick="saveNewData(this)"></i>';
    // }

    // function saveNewData(element) {
    //     var textarea = element.parentNode.parentNode.querySelector('textarea');
    //     var informasi = textarea.value;
    //     var inputNamaData = element.parentNode.parentNode.querySelector('input[name="nama_data"]');
    //     var namaData = inputNamaData.value;

    //     $.ajax({
    //         url: "ajax/save-new-marque.php",
    //         type: "POST",
    //         data: {
    //             informasi: informasi
    //         },
    //         success: function(response) {
    //             Swal.fire({
    //                 position: 'center-center',
    //                 icon: 'success',
    //                 title: 'Selamat :)',
    //                 text: 'Data baru berhasil ditambahkan',
    //                 footer: 'Sukses',
    //                 showConfirmButton: false,
    //                 timer: 3500
    //             }).then(() => {
    //                 location.reload();
    //             });
    //         },
    //         error: function(xhr, status, error) {
    //             Swal.fire({
    //                 title: 'Error!',
    //                 text: 'Gagal menambahkan data baru.',
    //                 icon: 'error',
    //                 showConfirmButton: false,
    //                 timer: 1500,
    //             });
    //         }
    //     });
    // }

    // function deleteRow(element) {
    //     var row = element.parentNode.parentNode;
    //     row.parentNode.removeChild(row);
    // }
</script>
<?php include 'views/partials/starter-foot.php'; ?>