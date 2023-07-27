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


    /* Warna Ikon */
    .instagram {
        color: #E1306C;
    }

    .facebook {
        color: #1877F2;
    }

    .youtube {
        color: #FF0000;
    }

    .twitter {
        color: #1DA1F2;
    }

    /* Efek Hover pada Ikon */
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
                <h2 class="text-center text-light mb-5 mt-2">Update link media sosial</h2>

                <?php foreach ($getinstagram as $a) : ?>
                    <div class="mb-3 input-group input-group">
                        <span class="input-group-text p-2 instagram"><i class="fa-brands fa-instagram"></i></span>
                        <input type="text" class="form-control p-1 px-2" name="informasi" value="<?= $a['informasi']; ?>" id="input-instagram-<?= $a['id']; ?>" data-id="<?= $a['id']; ?>" data-type="instagram" readonly aria-describedby="<?= $a['nama_data']; ?>">
                        <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-instagram-<?= $a['id']; ?>')"></i>
                        <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('<?= $a['id']; ?>', 'instagram')"></i>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($getfacebook as $a) : ?>
                    <div class="mb-3 input-group">
                        <span class="input-group-text p-2 facebook"><i class="fa-brands fa-facebook"></i></span>
                        <input type="text" class="form-control p-1 px-2" name="informasi" value="<?= $a['informasi']; ?>" id="input-facebook-<?= $a['id']; ?>" data-id="<?= $a['id']; ?>" data-type="facebook" readonly aria-describedby="<?= $a['nama_data']; ?>">
                        <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-facebook-<?= $a['id']; ?>')"></i>
                        <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('<?= $a['id']; ?>', 'facebook')"></i>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($getyoutube as $a) : ?>
                    <div class="mb-3 input-group">
                        <span class="input-group-text p-2 youtube"><i class="fa-brands fa-youtube"></i></span>
                        <input type="text" class="form-control p-1 px-2" name="informasi" value="<?= $a['informasi']; ?>" id="input-youtube-<?= $a['id']; ?>" data-id="<?= $a['id']; ?>" data-type="youtube" readonly aria-describedby="<?= $a['nama_data']; ?>">
                        <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-youtube-<?= $a['id']; ?>')"></i>
                        <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('<?= $a['id']; ?>', 'youtube')"></i>
                    </div>
                <?php endforeach; ?>

                <?php foreach ($gettwitter as $a) : ?>
                    <div class="mb-3 input-group">
                        <span class="input-group-text p-2 twitter"><i class="fa-brands fa-twitter"></i></span>
                        <input type="text" class="form-control p-1 px-2" name="informasi" value="<?= $a['informasi']; ?>" id="input-twitter-<?= $a['id']; ?>" data-id="<?= $a['id']; ?>" data-type="twitter" readonly aria-describedby="<?= $a['nama_data']; ?>">
                        <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-twitter-<?= $a['id']; ?>')"></i>
                        <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('<?= $a['id']; ?>', 'twitter')"></i>
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
            url: "ajax/update-medsos.php",
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