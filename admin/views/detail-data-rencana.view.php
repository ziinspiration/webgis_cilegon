<?php include 'views/partials/starter-head.php' ?>
<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Daftar data rencana</h1>
    <div class="row w-75 m-auto">
        <!-- Search -->
        <div class="input-group searching mb-2 mt-5">
            <input type="search" name="keyword" id="keyword" class="form-control input-search" placeholder="Cari disini" aria-label="Cari disini" aria-describedby="button-addon2">
            <button class="btn btn-search btn-outline-secondary" name="search" id="search-button" type="submit" id="cari"><i class="bi bi-search"></i></button>
        </div>
        <!-- Table -->
        <div id="search-container" class="table-responsive mt-5">
            <table class="table table-striped m-auto mt-1">
                <thead>
                    <tr class="fofa">
                        <th scope="col">data1</th>
                        <th scope="col">data2</th>
                        <th scope="col">data3</th>
                        <?php if (!empty($getdata[0]['data4'])) : ?>
                            <th scope="col">data4</th>
                        <?php endif; ?>
                        <th scope="col">data5</th>
                        <th scope="col">data6</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getdata as $a) : ?>
                        <tr>
                            <td><?= $a['data1']; ?></td>
                            <td><?= $a['data2']; ?></td>
                            <td><?= $a['data3']; ?></td>
                            <?php if (!empty($a['data4'])) : ?>
                                <td><?= $a['data4']; ?></td>
                            <?php endif; ?>
                            <td><?= $a['data5']; ?></td>
                            <td><?= $a['data6']; ?></td>
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
        fetch("ajax/search-data-rencana.php?keyword=" + keyword.value + "&id=<?php echo $id; ?>")
            .then((response) => response.text())
            .then((text) => (searchContainer.innerHTML = text));
    };
</script>
<?php include 'views/partials/starter-foot.php' ?>