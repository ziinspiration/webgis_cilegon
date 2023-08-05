<?php include 'views/partials/starter-head.php' ?>
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
                <div class="profile-picture d-flex flex-column mb-3">
                    <?php if (!empty($admin['foto_profile'])) : ?>
                        <img src="<?= $admin['foto_profile']; ?>" class="w-25 rounded-circle" alt="Profile Picture">
                    <?php else : ?>
                        <img src="../assets/index/profile-picture.jpg" class="w-25 rounded-circle" alt="Default Profile Picture">
                    <?php endif; ?>
                    <input type="file" onchange="updateProfilePicture(this)" class="form-control w-25 p-2 mt-2" name="foto_profile" accept="image/*" onchange="previewImage(this)">
                </div>
                <div class="input-group mb-3 w-75 d-flex align-items-center">
                    <span class="input-group-text p-3" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control p-3" name="nama_pegawai" value="<?= $admin['nama_pegawai']; ?>" aria-describedby="basic-addon1" readonly>
                    <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('nama_pegawai')"></i>
                </div>
                <div class="input-group mb-3 w-75 d-flex align-items-center">
                    <span class="input-group-text p-3" id="basic-addon1"><i class="fa-solid fa-id-badge"></i></span>
                    <input type="text" class="form-control p-3" name="nik" value="<?= $admin['nik']; ?>" aria-describedby="basic-addon1" readonly>
                    <i class="change text-primary fa-solid fa-pen ms-4" onclick="enableEdit('nik')"></i>
                </div>
                <p>Apakah anda ingin merubah password ? <a class="text-decoration-none" href="">KLIK
                        DISINI</a></p>
            </div>
            <div class="button d-flex justify-content-end mb-5">
                <button type="button" class="btn btn-primary me-5 p-2 px-3 rounded" onclick="saveChanges()"><i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<script>
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
        var foto_profile = document.getElementsByName("foto_profile")[0].value;

        $.ajax({
            url: "ajax/save-profile.php",
            type: "POST",
            data: {
                nik: nik,
                nama_pegawai: nama_pegawai,
                foto_profile: foto_profile, // Include the new profile picture data
            },
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
</script>
<?php include 'views/partials/starter-foot.php' ?>