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
<div id="loading-spinner" style="display: none;">
    <img class="load-animation" src="assets/index/loading-animation.gif" alt="">
    <h5 class="text-center text-loading">Sedang memuat...</h5>
</div>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include 'partials/starter-foot.php' ?>

<script>
    function showLoading() {
        document.getElementById("loading-spinner").style.display = "block";
    }

    function hideLoading() {
        document.getElementById("loading-spinner").style.display = "none";
    }

    const images = document.querySelectorAll(".container img");

    const totalImages = images.length;

    let imagesLoaded = 0;

    function imageLoaded() {
        imagesLoaded++;
        if (imagesLoaded === totalImages) {
            hideLoading();
        }
    }

    images.forEach(function(image) {
        image.addEventListener("load", imageLoaded);
        image.addEventListener("error", imageLoaded);
    });

    showLoading();

    window.addEventListener("load", function() {
        hideLoading();
    });
</script>