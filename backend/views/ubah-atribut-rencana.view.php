<?php
require 'views/partials/starter-head.php';
require 'views/partials/alert-hapus.php';
?>
<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data rencana</h1>
    <div class="row w-75 m-auto">
        <!-- Table -->
        <div id="search-container" class="table-responsive mt-5">
            <table class="table table-striped m-auto mt-1">
                <thead>
                    <tr class="fofa">
                        <th scope="col">Kecamatan</th>
                        <th scope="col">Kelurahan</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Sumber</th>
                        <th scope="col">Luas</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getdata as $a) : ?>
                        <tr>
                            <td><?= $a['kecamatan']; ?></td>
                            <td><?= $a['kelurahan']; ?></td>
                            <td><?= $a['keterangan']; ?></td>
                            <td><?= $a['sumber']; ?></td>
                            <td><?= $a['luas']; ?></td>
                            <td class="text-center">
                                <a class="text-decoration-none" href="form-update-atribut-rencana?id=<?= $a["id_atribut"] ?>">
                                    <span class="badge bdg-a text-bg-warning p-2"><i class="fa-regular fa-pen-to-square"></i>Ubah</span>
                                </a>
                                <span class="fw-bold spase">|</span>
                                <a href="javascript:void(0);" class="hapusData" data-id-atribut="<?= $a["id_atribut"] ?>" data-id-pokok="<?= $a["id_pokok"] ?>">
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
    const hapusButtons = document.getElementsByClassName('hapusData');
    for (let i = 0; i < hapusButtons.length; i++) {
        hapusButtons[i].addEventListener('click', function(event) {
            event.preventDefault();

            // Dapatkan data id_atribut dan id_pokok dari atribut data
            const idAtribut = this.getAttribute('data-id-atribut');
            const idPokok = this.getAttribute('data-id-pokok');

            // Gunakan SweetAlert untuk dialog konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak',
                didOpen: () => {
                    const sweetAlertContainer = document.querySelector('.swal2-container');
                    if (sweetAlertContainer) {
                        sweetAlertContainer.style.padding =
                            '20px'; // Sesuaikan padding sesuai kebutuhan
                        const sweetAlertIcon = sweetAlertContainer.querySelector('.swal2-icon');
                        if (sweetAlertIcon) {
                            sweetAlertIcon.style.marginBottom =
                                '15px'; // Sesuaikan margin sesuai kebutuhan
                        }
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("Data dengan ID Atribut " + idAtribut + " dan ID Pokok " + idPokok +
                        " telah dihapus!");

                    // Lakukan tindakan penghapusan (misalnya, hapus data dari server)
                    window.location.href = "functions/delete-atribut-rencana.php?id_atribut=" +
                        idAtribut + "&id_pokok=" + idPokok;
                } else {
                    console.log("Penghapusan dibatalkan.");
                }
            });
        });
    }
</script>
<?php include 'views/partials/starter-foot.php' ?>