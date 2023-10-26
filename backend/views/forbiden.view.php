<?php include 'views/partials/starter-head.php' ?>
<style>
body {
    /* font-family: Arial, sans-serif; */
    font-family: poppins !important;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h1 {
    font-size: 36px;
    color: #e74c3c;
}

h2 {
    font-size: 70px;
}

.desk {
    font-size: 18px;
    color: #333;
}

.copy {
    font-size: 10px !important;
}

@media screen and (max-width: 550px) {
    .container {
        width: 90%;
        margin: auto;
        padding: 10px;
    }

    .desk {
        font-size: 10px !important;
    }

    .copy {
        font-size: 8px !important;
    }
}
</style>
<div class="container pt-5 pb-2">
    <h2 class="text-danger mb-3"><i class="fa-solid fa-ban fa-bounce"></i></h2>
    <h1>403 Forbidden</h1>
    <p class="mb-5 desk">Maaf, Anda tidak diizinkan mengakses halaman ini.</p>
    <p class="copy"><small>© 2023 Website Geospasial BAPPELITBANG Kota Cilegon. All rights reserved.</small></p>
</div>
<?php include 'views/partials/starter-foot.php' ?>