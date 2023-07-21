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
            <form action="" method="post" class="mb-5">
                <ul class="list-unstyled">
                    <h1>Link media sosial</h1>
                    <li class="d-flex flex-column">
                        <?php foreach ($getfacebook as $facebook) : ?>
                        <div class="input-group mb-3 input-medsos d-flex">
                            <span class="input-group-text"
                                id="<?= $facebook['nama_data']; ?>"><?= $facebook['nama_data']; ?></span>
                            <input type="text" class="form-control" name="informasi"
                                id="input-facebook-<?= $facebook['id']; ?>" data-id="<?= $facebook['id']; ?>"
                                data-type="facebook" value="<?= $facebook['informasi']; ?>" readonly
                                aria-describedby="<?= $facebook['nama_data']; ?>">
                            <i class="fa-regular fa-pen-to-square ms-2 iFunction"
                                onclick="enableEdit('input-facebook-<?= $facebook['id']; ?>')"></i>
                            <i class="fa-solid fa-floppy-disk ms-2 iFunction"
                                onclick="saveChanges('<?= $facebook['id']; ?>', 'facebook')"></i>
                        </div>
                        <?php endforeach; ?>
                    </li>
                    <li class="d-flex flex-column">
                        <?php foreach ($getinstagram as $instagram) : ?>
                        <div class="input-group mb-3 input-medsos d-flex">
                            <span class="input-group-text"
                                id="<?= $instagram['nama_data']; ?>"><?= $instagram['nama_data']; ?></span>
                            <input type="text" class="form-control" name="informasi"
                                id="input-instagram-<?= $instagram['id']; ?>" data-id="<?= $instagram['id']; ?>"
                                data-type="instagram" value="<?= $instagram['informasi']; ?>" readonly
                                aria-describedby="<?= $instagram['nama_data']; ?>">
                            <i class="fa-regular fa-pen-to-square ms-2 iFunction"
                                onclick="enableEdit('input-instagram-<?= $instagram['id']; ?>')"></i>
                            <i class="fa-solid fa-floppy-disk ms-2 iFunction"
                                onclick="saveChanges('<?= $instagram['id']; ?>', 'instagram')"></i>
                        </div>
                        <?php endforeach; ?>
                    </li>
                    <li class="d-flex flex-column">
                        <?php foreach ($getyoutube as $youtube) : ?>
                        <div class="input-group mb-3 input-medsos d-flex">
                            <span class="input-group-text"
                                id="<?= $youtube['nama_data']; ?>"><?= $youtube['nama_data']; ?></span>
                            <input type="text" class="form-control" name="informasi"
                                id="input-youtube-<?= $youtube['id']; ?>" data-id="<?= $youtube['id']; ?>"
                                data-type="youtube" value="<?= $youtube['informasi']; ?>" readonly
                                aria-describedby="<?= $youtube['nama_data']; ?>">
                            <i class="fa-regular fa-pen-to-square ms-2 iFunction"
                                onclick="enableEdit('input-youtube-<?= $youtube['id']; ?>')"></i>
                            <i class="fa-solid fa-floppy-disk ms-2 iFunction"
                                onclick="saveChanges('<?= $youtube['id']; ?>', 'youtube')"></i>
                        </div>
                        <?php endforeach; ?>
                    </li>
                    <li class="d-flex flex-column">
                        <?php foreach ($gettwitter as $twitter) : ?>
                        <div class="input-group mb-3 input-medsos d-flex">
                            <span class="input-group-text"
                                id="<?= $twitter['nama_data']; ?>"><?= $twitter['nama_data']; ?></span>
                            <input type="text" class="form-control" name="informasi"
                                id="input-twitter-<?= $twitter['id']; ?>" data-id="<?= $twitter['id']; ?>"
                                data-type="twitter" value="<?= $twitter['informasi']; ?>" readonly
                                aria-describedby="<?= $twitter['nama_data']; ?>">
                            <i class="fa-regular fa-pen-to-square ms-2 iFunction"
                                onclick="enableEdit('input-twitter-<?= $twitter['id']; ?>')"></i>
                            <i class="fa-solid fa-floppy-disk ms-2 iFunction"
                                onclick="saveChanges('<?= $twitter['id']; ?>', 'twitter')"></i>
                        </div>
                        <?php endforeach; ?>
                    </li>
                </ul>
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
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        customClass: {
            popup: 'my-swal-popup-class', // Nama kelas CSS kustom
        },
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
                        title: 'Deleted!',
                        text: 'The data has been deleted.',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'my-swal-popup-class', // Nama kelas CSS kustom
                        },
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to delete the data.',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: {
                            popup: 'my-swal-popup-class', // Nama kelas CSS kustom
                        },
                    });
                }
            });
        }
    });
}
</script>
<?php include 'views/partials/starter-foot.php'; ?>