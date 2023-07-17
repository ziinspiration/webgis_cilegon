<?php include 'partials/starter-head.php' ?>
<?php
date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu sesuai kebutuhan

$jam = date('H'); // Mendapatkan jam saat ini (format 24 jam)

if ($jam >= 3 && $jam < 10) {
    $salam = 'Pagi';
} elseif ($jam >= 10 && $jam < 15) {
    $salam = 'Siang';
} elseif ($jam >= 15 && $jam < 18) {
    $salam = 'Sore';
} else {
    $salam = 'Malam';
}

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="header text-light mb-4 mt-4">
                <div class="salam">
                    <h1 class="text-center">Selamat <span class="orange" id="greeting"></span></h1>
                </div>
                <img src="../assets/logo/cilegon.png" alt="" class="d-flex m-auto mt-3 mb-3 w-25">
                <h5 class="text-center">Di Dashboard <span class="orange">WEB GIS CILEGON</span></h5>
            </div>
            <?php if (isset($_SESSION['error'])) : ?>
            <div id="alert" class="alert alert-danger error mb-3 text-center px-2 py-3" role="alert">
                <p><b>Proses login gagal !</b> <br> NIK atau Password yang dimasukkan tidak valid</p>
            </div>
            <?php endif; ?>
            <form action="" method="post" class="card p-4 bg-dark rounded-4">
                <div class="form-group mb-3">
                    <label for="nik" class="orange mb-1">NIK Pegawai</label>
                    <div class="d-flex align-items-center">
                        <i class="bi icon bi-person-fill me-1 text-secondary"></i>
                        <input type="text" class="form-control pt-1 pb-1" id="nik" name="nik"
                            placeholder="Masukkan NIK Pegawai">
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="password" class="orange mb-1">Password</label>
                    <div class="d-flex align-items-center">
                        <i class="bi icon bi-lock-fill me-1 text-secondary"></i>
                        <input type="password" class="form-control pt-1 pb-1" id="password" name="password"
                            placeholder="Masukkan Password">
                        <div class="input-icon text-secondary ms-2">
                            <i class="bi bi-eye-fill toggle-password"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block p-2">Login</button>
            </form>
        </div>
    </div>
</div>

<?php include 'views/partials/script.php' ?>
<script>
var greetings = ["Datang", "<?= $salam; ?>"];
var index = 0;
var greetingElement = document.getElementById("greeting");

function changeGreeting() {
    var greeting = greetings[index];
    var characters = greeting.split("");
    greetingElement.textContent = ""; // Menghapus konten sebelumnya

    var interval = setInterval(function() {
        greetingElement.textContent += characters.shift();

        if (characters.length === 0) {
            clearInterval(interval);
            setTimeout(function() {
                index = (index + 1) % greetings.length;
                changeGreeting();
            }, 2500);
        }
    }, 150);
}

changeGreeting(); // Memanggil fungsi untuk memulai perubahan salam secara otomatis
</script>
<?php include 'partials/starter-foot.php' ?>