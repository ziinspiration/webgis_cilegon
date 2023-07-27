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
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="w-75 content align-content-center">
            <form class="px-5 py-4 bg-dark rounded-4" action="" method="post">
                <h2 class="text-center text-light mb-5 mt-2">Update informasi kontak</h2>

                <?php foreach ($getAlamat as $a) : ?>
                    <div class="mb-3 input-group">
                        <span class="input-group-text p-2 alamat"><i class="fa-solid fa-location-dot"></i></span>
                        <input type="text" class="form-control p-1 px-2" name="informasi" value="<?= $a['informasi']; ?>" id="input-alamat-<?= $a['id']; ?>" data-id="<?= $a['id']; ?>" data-type="alamat" readonly aria-describedby="<?= $a['nama_data']; ?>">
                        <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-alamat-<?= $a['id']; ?>')"></i>
                        <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('<?= $a['id']; ?>', 'alamat')"></i>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($getEmail as $a) : ?>
                    <div class="mb-3 input-group">
                        <span class="input-group-text p-2 email"><i class="fa-solid fa-envelope"></i></span>
                        <input type="text" class="form-control p-1 px-2" name="informasi" value="<?= $a['informasi']; ?>" id="input-email-<?= $a['id']; ?>" data-id="<?= $a['id']; ?>" data-type="email" readonly aria-describedby="<?= $a['nama_data']; ?>">
                        <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-email-<?= $a['id']; ?>')"></i>
                        <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('<?= $a['id']; ?>', 'email')"></i>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($getPhone as $a) : ?>
                    <div class="mb-3 input-group input-group">
                        <span class="input-group-text p-2 telphone"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" class="form-control p-1 px-2" name="informasi" value="<?= $a['informasi']; ?>" id="input-telphone-<?= $a['id']; ?>" data-id="<?= $a['id']; ?>" data-type="telphone" readonly aria-describedby="<?= $a['nama_data']; ?>">
                        <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-telphone-<?= $a['id']; ?>')"></i>
                        <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('<?= $a['id']; ?>', 'telphone')"></i>
                    </div>
                <?php endforeach; ?>

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
            url: "ajax/update-contact.php",
            type: "POST",
            data: {
                id: id, // Tambahkan id ke data yang dikirimkan
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
</script>
<?php include 'views/partials/starter-foot.php'; ?>