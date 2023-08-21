<?php
require 'views/partials/starter-head.php';
require 'views/partials/alert-hapus.php';
?>
<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data prasarana</h1>
    <div class="row w-75 m-auto">
        <!-- Search -->
        <!-- <div class="input-group searching mb-2 mt-5">
            <input type="search" name="keyword" id="keyword" class="form-control input-search" placeholder="Cari disini" aria-label="Cari disini" aria-describedby="button-addon2">
            <button class="btn btn-search btn-outline-secondary" name="search" id="search-button" type="submit" id="cari"><i class="bi bi-search"></i></button>
        </div> -->
        <!-- Table -->
        <div id="search-container" class="table-responsive mt-5">
            <table class="table table-striped m-auto mt-1">
                <thead>
                    <tr class="fofa">
                        <th scope="col">Nama</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">X</th>
                        <th scope="col">Y</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getdata as $a) : ?>
                        <tr>
                            <td><?= $a['nama']; ?></td>
                            <td><?= $a['keterangan']; ?></td>
                            <td><?= $a['jenis']; ?></td>
                            <td><?= $a['x']; ?></td>
                            <td><?= $a['y']; ?></td>
                            <td class="text-center">
                                <a class="text-decoration-none" href="form-update-atribut-prasarana?id=<?= $a["id_atribut"] ?>">
                                    <span class="badge bdg-a text-bg-warning p-2"><i class="fa-regular fa-pen-to-square"></i>Ubah</span>
                                </a>
                                <span class="fw-bold spase">|</span>
                                <a href="javascript:void(0);" class="hapusData" id_atribut="<?= $a["id_atribut"] ?>">
                                    <span class="badge text-bg-danger p-2"><i class="fa-solid fa-trash"></i> Hapus</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<script>
    // Menggunakan class 'hapusData' sebagai selector untuk tombol hapus
    const hapusButtons = document.getElementsByClassName('hapusData');
    for (let i = 0; i < hapusButtons.length; i++) {
        hapusButtons[i].addEventListener('click', function(event) {
            event.preventDefault();

            // Use SweetAlert for the confirmation dialog
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak',
                didOpen: () => {
                    const sweetAlertContainer = document.querySelector('.swal2-container');
                    if (sweetAlertContainer) {
                        sweetAlertContainer.style.padding = '20px'; // Atur padding sesuai kebutuhan
                        const sweetAlertIcon = sweetAlertContainer.querySelector('.swal2-icon');
                        if (sweetAlertIcon) {
                            sweetAlertIcon.style.marginBottom = '15px'; // Atur margin sesuai kebutuhan
                        }
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("Data dengan ID " + hapusButtons[i].getAttribute('id_atribut') +
                        " telah dihapus!");

                    // Perform deletion action (e.g., delete data from the server)
                    window.location.href = "functions/delete-atribut-prasarana.php?id=" + hapusButtons[i]
                        .getAttribute(
                            'id_atribut');
                } else {
                    console.log("Penghapusan dibatalkan.");
                }
            });
        });
    }
</script>
<?php include 'views/partials/starter-foot.php' ?>