<?php include 'partials/starter-head.php' ?>
<?php include 'partials/nav.php' ?>
<?php include 'partials/breadcrumb.php' ?>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="mb-5 mt-2">
                <?php foreach ($getdata as $a) : ?>
                    <img src="assets/struktur/<?= $a['file']; ?>" class="w-100 p-4 bg-secondary-subtle rounded-4 border border-1 border-dark" alt="">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include 'partials/starter-foot.php' ?>