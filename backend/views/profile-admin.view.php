<?php include 'views/partials/starter-head.php' ?>
<?php include 'views/partials/alert-tambah-data.php'; ?>
<style>
    .content {
        font-family: Poppins;
    }

    .bold-profile {
        font-weight: 600 !important;
        color: rgb(187, 186, 186) !important;
    }

    .input-group-text i {
        font-size: 25px;
    }

    .change {
        color: grey !important;
        font-size: 20px;
        transition: all 0.2s;
    }

    .change:hover {
        color: orange !important;
        font-size: 22px;
    }

    .profile-picture img {
        width: 250px !important;
        height: 250px !important;
        border: 3px solid whitesmoke;
        outline: 2px solid lightgray;
        box-shadow: 0 0 5px lightgray;
        margin-bottom: 13px !important;
    }

    @media screen and (max-width:990px) {
        .grup {
            width: 100% !important;
        }

        .profile-picture img {
            margin: auto !important;
            margin-bottom: 20px !important;
        }
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div>
                <?php include 'partials/sidebar.php' ?>
            </div>
        </div>
        <div class="col-md-9">
            <div class="content">
                <form enctype="multipart/form-data">
                    <div class="profile-picture d-flex flex-column mb-4">
                        <?php
                        $profilePicture = !empty($admin['foto_profile']) ? "../assets/profile_picture/{$admin['foto_profile']}" : "../assets/index/profile-picture.jpg";
                        $altText = !empty($admin['foto_profile']) ? "Profile Picture" : "Default Profile Picture";
                        ?>
                        <img src="<?= $profilePicture; ?>" class="w-25 rounded-circle" alt="<?= $altText; ?>">
                        <input type="file" onchange="previewImage(this)" class="form-control input-image w-50 p-2 mt-2 grup" name="new_foto_profile" accept="image/*">
                    </div>
                    <hr class="mb-4">
                    <div class="input-group mb-3 w-75 d-flex align-items-center grup">
                        <span class="input-group-text p-3" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                        <input type="text" class="form-control p-3" name="nama_pegawai" value="<?= $admin['nama_pegawai']; ?>" aria-describedby="basic-addon1" readonly>
                        <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('nama_pegawai')"></i>
                    </div>
                    <div class="input-nik mb-3">
                        <div class="input-group w-75 d-flex align-items-center grup">
                            <span class="input-group-text p-3" id="basic-addon1"><i class="fa-solid fa-id-badge"></i></span>
                            <input type="text" class="form-control p-3" name="nik" id="nik" value="<?= $admin['nik']; ?>" aria-describedby="basic-addon1" readonly>
                            <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('nik')"></i>
                        </div>
                        <span id="nik-error" class="text-danger ms-5 mt-1"></span>
                    </div>
                    <p>Apakah anda ingin merubah password ? <a class="text-decoration-none" href="../auth/change-password?id=<?= $admin["id"] ?>">KLIK
                            DISINI</a></p>
            </div>
            <div class="button d-flex justify-content-end mb-5">
                <button type="button" class="btn btn-primary me-5 p-2 px-3 rounded" onclick="saveChanges()"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<script>
    document.getElementById("nik").addEventListener("input", function() {
        var nikInput = this.value;
        var errorElement = document.getElementById("nik-error");

        if (!/^\d+$/.test(nikInput)) {
            errorElement.textContent = "*NIK hanya boleh berisi angka";
        } else {
            errorElement.textContent = "";
        }
    });

    function previewImage(input) {
        var imgElement = document.querySelector('.profile-picture img');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                imgElement.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function enableEdit(field) {
        var inputField = document.getElementsByName(field)[0];
        inputField.removeAttribute("readonly");
        inputField.focus();
    }

    function saveChanges() {
        var nik = document.getElementsByName("nik")[0].value;
        var nama_pegawai = document.getElementsByName("nama_pegawai")[0].value;
        var new_foto_profile_input = document.getElementsByName("new_foto_profile")[0];
        var new_foto_profile = new_foto_profile_input.files[0];

        var formData = new FormData();
        formData.append("nik", nik);
        formData.append("nama_pegawai", nama_pegawai);
        formData.append("new_foto_profile", new_foto_profile);

        $.ajax({
            url: "ajax/save-profile.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    position: 'center-center',
                    icon: 'success',
                    title: 'Selamat :)',
                    text: 'Perubahan anda berhasil tersimpan',
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
<?php include 'views/partials/starter-foot.php' ?>