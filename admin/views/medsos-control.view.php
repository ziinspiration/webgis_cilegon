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
                <div class="mb-3 input-group input-group">
                    <span class="input-group-text p-2 instagram" id="instagram"><i class="fa-brands fa-instagram"></i></span>
                    <input type="text" class="form-control p-1 px-2" name="informasi" id="input-instagram" data-type="instagram" value="https://www.instagram.com/" readonly aria-describedby="instagram">
                    <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-instagram')"></i>
                    <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('instagram')"></i>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text p-2 facebook" id="facebook"><i class="fa-brands fa-facebook"></i></span>
                    <input type="text" class="form-control p-1 px-2" name="informasi" id="input-facebook" data-type="facebook" value="https://www.facebook.com/" readonly aria-describedby="facebook">
                    <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-facebook')"></i>
                    <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('facebook')"></i>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text p-2 youtube" id="youtube"><i class="fa-brands fa-youtube"></i></span>
                    <input type="text" class="form-control p-1 px-2" name="informasi" id="input-youtube" data-type="youtube" value="https://www.youtube.com/" readonly aria-describedby="youtube">
                    <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-youtube')"></i>
                    <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('youtube')"></i>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text p-2 twitter" id="twitter"><i class="fa-brands fa-twitter"></i></span>
                    <input type="text" class="form-control p-1 px-2" name="informasi" id="input-twitter" data-type="twitter" value="https://twitter.com/" readonly aria-describedby="twitter">
                    <i class="fa-regular fa-pen-to-square ms-2 iFunction" onclick="enableEdit('input-twitter')"></i>
                    <i class="fa-solid fa-floppy-disk ms-2 iFunction" onclick="saveChanges('twitter')"></i>
                </div>
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

    function saveChanges(type) {
        var informasi = document.getElementById(`input-${type}`).value;

        $.ajax({
            url: "ajax/update-informasi.php",
            type: "POST",
            data: {
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