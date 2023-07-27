<?php include 'views/partials/starter-head.php' ?>
<div class="btn-grp p-3">
    <a href="index.php" class="btn btn-primary p-2"><i class="fa-solid fa-table"></i> Dashboard</a>
    <a href="logout.php" class="btn btn-danger p-2"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>
<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data pegawai</h1>
    <div class="row w-75 m-auto">
        <!-- Search -->
        <div class="input-group searching mb-2 mt-5">
            <input type="search" name="keyword" id="keyword" class="form-control input-search" placeholder="Cari disini" aria-label="Cari disini" aria-describedby="button-addon2">
            <button class="btn btn-search btn-outline-secondary" name="search" id="search-button" type="submit" id="cari"><i class="bi bi-search"></i></button>
        </div>
        <!-- Table -->
        <div id="search-container" class="table-responsive">
            <table class="table table-striped m-auto mt-1">
                <thead>
                    <tr class="fofa">
                        <th scope="col">No</th>
                        <th scope="col">Nama pegawai</th>
                        <th scope="col">NIK</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getdata as $i => $a) : ?>
                        <tr>
                            <th class="text-center" scope="row"><?= $i + 1; ?></th>
                            <td><?= $a['nama_pegawai']; ?></td>
                            <td><?= $a['nik']; ?></td>
                            <td class="text-center">
                                <a href="form-update-akun.php?id=<?= $a["id"] ?>"><span class="badge bdg-a text-bg-warning p-2"><i class="fa-regular fa-pen-to-square"></i>Ubah</span></a>
                                <span class="fw-bold spase">|</span>
                                <a href="functions/delete-akun.php?id=<?= $a["id"] ?>" class="hapusData" id_akun="<?= $a["id"] ?>"><span class="badge text-bg-danger p-2"><i class="fa-solid fa-trash"></i> Hapus</span></a>
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
    const keyword = document.getElementById("keyword");
    const searchButton = document.getElementById("search-button");
    const searchContainer = document.getElementById("search-container");

    keyword.onkeyup = function() {
        fetch("ajax/search-update-akun.php?keyword=" + keyword.value)
            .then((response) => response.text())
            .then((text) => (searchContainer.innerHTML = text));
    };


    // Menggunakan class 'hapusData' sebagai selector untuk tombol hapus
    const hapusButtons = document.getElementsByClassName('hapusData');
    for (let i = 0; i < hapusButtons.length; i++) {
        hapusButtons[i].addEventListener('click', function(event) {
            event.preventDefault();
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus?");
            if (konfirmasi) {
                console.log("Data dengan ID " + hapusButtons[i].getAttribute('id_akun') + " telah dihapus!");
                // Tambahkan tindakan penghapusan di sini (misalnya, hapus data dari server)
                window.location.href = "functions/delete-akun.php?id=" + hapusButtons[i].getAttribute('id_akun');
            } else {
                console.log("Penghapusan dibatalkan.");
            }
        });
    }
</script>
<?php include 'views/partials/starter-foot.php' ?>