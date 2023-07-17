<?php include 'views/partials/starter-head.php' ?>
<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data administrasi</h1>
    <div class="row w-75 m-auto">
        <!-- Search -->
        <div class="input-group searching mb-2 mt-5">
            <input type="search" name="keyword" id="keyword" class="form-control input-search" placeholder="Cari disini"
                aria-label="Cari disini" aria-describedby="button-addon2">
            <button class="btn btn-search btn-outline-secondary" name="search" id="search-button" type="submit"
                id="cari"><i class="bi bi-search"></i></button>
        </div>
        <!-- Table -->
        <div id="search-container" class="table-responsive">
            <table class="table table-striped m-auto mt-1">
                <thead>
                    <tr class="fofa">
                        <th scope="col">No</th>
                        <th scope="col">Nama data</th>
                        <th scope="col">File geojson</th>
                        <th class="text-center" scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getdata as $i => $a) : ?>
                    <tr>
                        <th class="text-center" scope="row"><?= $i + 1; ?></th>
                        <td><?= $a['nama_adm']; ?></td>
                        <td><?= $a['file_json']; ?></td>
                        <td class="text-center"><a href="detail-administrasi.php?id=<?= $a["id"] ?>"><i
                                    class="bi bi-eye-fill"></i></a></td>
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
    fetch("ajax/search-administrasi.php?keyword=" + keyword.value)
        .then((response) => response.text())
        .then((text) => (searchContainer.innerHTML = text));
};
</script>
<?php include 'views/partials/starter-foot.php' ?>