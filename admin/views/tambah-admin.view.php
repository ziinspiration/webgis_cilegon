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
<?php include 'views/partials/starter-head.php' ?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <div class="header text-light mb-4 mt-4">
                <div class="salam">
                    <h1 class="text-center">Selamat <span class="orange" id="greeting"></span></h1>
                </div>
                <img src="../assets/logo/cilegon.png" alt="" class="d-flex m-auto mt-3 mb-3 w-25">
                <h5 class="text-center">Di Registrasi admin <span class="orange">WEB GIS CILEGON</span></h5>
            </div>
            <form class="card w-100 p-5 mb-5 m-auto bg-dark" action="" method="post">
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama_pegawai" class="form-label user-label orange ps-1 pe-1">Nama pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control username-input border-orange"
                        id="nama_pegawai" placeholder="Masukkan nama_pegawai" required />
                </div>
                <!-- NIK -->
                <div class="mb-3">
                    <label for="nik" class="form-label user-label orange ps-1 pe-1">NIK</label>
                    <input type="text" name="nik" class="form-control username-input border-orange" id="nik"
                        placeholder="Masukkan nik" required />
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label password-label orange ps-1 pe-1">Password</label>
                    <input type="password" name="password" class="form-control password-input border-orange"
                        id="password" placeholder="Masukkan Password" required />
                </div>
                <!-- Repeat Password -->
                <div class="mb-3">
                    <label for="password2" class="form-label password-label orange ps-1 pe-1">Konfirmasi
                        Password</label>
                    <input type="text" name="password2" class="form-control password-input border-orange" id="password2"
                        placeholder="Masukkan Password" required />
                </div>
                <button type="submit" name="register" class="btn btn-primary m-auto w-50 p-2">
                    Daftar
                </button>
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
<?php include 'views/partials/starter-foot.php' ?>