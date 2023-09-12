<?php
include 'views/partials/starter-head.php';
?>
<?php require_once 'views/partials/alert-tambah-data.php'; ?>
<style>
    .table-res {
        overflow-y: auto !important;
    }

    @media screen and (max-width:990px) {
        .search-class {
            width: 65% !important;
        }
    }

    .table {
        font-family: Montserrat;
    }

    th {
        padding: 10px !important;
    }

    td {
        padding: 10px !important;
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pengguna</th>
                            <th scope="col">Kritik / Saran</th>
                            <th scope="col">Aksi</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getdata as $a) : ?>
                            <tr>
                                <th class="text-center" scope="row"><a class="text-decoration-none text-dark" href="detail-kritik-saran?id=<?= $a['id']; ?>"><?= $i++; ?></a></th>
                                <td class=""><a class="text-decoration-none text-dark" href="detail-kritik-saran?id=<?= $a['id']; ?>"><?= $a['nama_pengguna']; ?></a></td>
                                <td><a class="text-decoration-none text-dark" href="detail-kritik-saran?id=<?= $a['id']; ?>"><?= $a['isi_terbatas']; ?>...</a>
                                </td>
                                <td><a href="detail-kritik-saran?id=<?= $a['id']; ?>">Balas</a></td>
                                <td class="text-center <?php echo empty($a['jawaban']) ? 'text-danger' : 'text-success'; ?>">
                                    <i class="fa-solid fa-circle"></i>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="info mt-4 ms-3">
                    <p><i class="fa-solid fa-circle text-success"></i> Sudah dibalas</p>
                    <p><i class="fa-solid fa-circle text-danger"></i> Belum dibalas</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<?php include 'views/partials/starter-foot.php' ?>