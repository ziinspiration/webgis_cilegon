<?php include 'views/partials/starter-head.php' ?>
<?php include 'views/partials/alert-tambah-data.php'; ?>
<style>
body {
    background-color: #f8f9fa !important;
}
</style>
<div class="container-fluid mt-5">
    <div class="accordion w-50 m-auto " id="accordionExample">
        <?php foreach ($getdata as $data) : ?>
        <div class="accordion-item border border-dark-subtle">
            <h2 class="accordion-header">
                <button class="accordion-button p-3 bg-dark-subtle text-dark" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="bi bi-person-circle me-1"></i> <?= $data['nama_pengguna']; ?>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show p-3" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <h5>Kritik & Saran :</h5>
                    <p class="mt-2 ms-3"><?= $data['isi']; ?></p>
                </div>
            </div>
        </div>
        <div class="accordion-item border border-dark-subtle">
            <h2 class="accordion-header ">
                <button class="accordion-button p-3 bg-dark-subtle text-dark" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i>Klik disini untuk membalas</i>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show p-3" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control p-3" name="jawaban" id="jawaban">
                            <input type="hidden" name="id" id="id" value="<?= $data['id']; ?>">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary p-1 px-3">Balas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = koneksi();

    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    $jawaban = $_POST["jawaban"];

    $id = $_POST["id"];

    $sql = "UPDATE saran_kritik SET jawaban = '$jawaban' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
        Swal.fire({
            title: 'Sukses!',
            text: 'Jawaban berhasil disimpan.',
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            window.location.href = 'kritik-saran'; 
        });
    </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan data: " . mysqli_error($conn) . "',
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            });
        </script>";
    }

    mysqli_close($conn);
}
?>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>