<?php include 'views/partials/starter-head.php' ?>
<style>
@media screen and (max-width: 900px) {
    .content {
        flex-direction: column !important;
    }

    .child-content {
        margin: 20px !important;
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
            <div class="content d-flex justify-content-around mt-5">
                <div class="child-content">
                    <a href="medsos-control.php" class="card bg-light text-center text-decoration-none p-5">
                        <i class="fa-solid fa-link mb-3"></i>
                        <p>Media sosial</p>
                    </a>
                </div>
                <div class="child-content">
                    <a href="information-control.php" class="card bg-light text-center text-decoration-none p-5">
                        <i class="fa-solid fa-circle-info mb-3"></i>
                        <p>Informasi text</p>
                    </a>
                </div>
                <div class="child-content">
                    <a href="contact-control.php" class="card bg-light text-center text-decoration-none p-5">
                        <i class="fa-solid fa-phone mb-3"></i>
                        <p>Informasi kontak</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php include 'views/partials/script.php' ?>
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
<?php include 'views/partials/starter-foot.php' ?>