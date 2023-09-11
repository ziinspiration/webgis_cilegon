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
            <?php
                if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) {
                    $remaining_time = $_SESSION['lockout_time'] - time();
                    $minutes = floor($remaining_time / 60);
                    $seconds = $remaining_time % 60;
                    $lockout_message = "Terlalu banyak percobaan login gagal. Silakan coba lagi dalam 5 menit";
                } else {
                    $remaining_attempts = 5 - $_SESSION['failed_login_count'];
                    if ($remaining_attempts > 0) {
                        $login_attempts_message = "Sisa percobaan login : $remaining_attempts";
                    } else {
                        // Tambahkan pesan ketika sisa percobaan login habis
                        $login_attempts_message = "Sisa percobaan login telah habis. Silakan coba lagi dalam 5 menit.";
                    }
                }
                ?>
            <div id="alert" class="alert alert-danger error mb-3 text-center px-2 py-3" role="alert">
                <p><b>Proses login gagal !</b><br>
                    <?php if (isset($lockout_message)) : ?>
                    <?= $lockout_message ?>
                    <?php elseif ($remaining_attempts > 0) : ?>
                    NIP atau Password yang dimasukkan tidak valid<br>
                    <?= $login_attempts_message ?>
                    <?php endif; ?>
                </p>
            </div>
            <?php endif; ?>
            <form action="" method="post" class="card p-4 bg-dark rounded-4">
                <div class="form-group mb-3">
                    <label for="nik" class="orange mb-1">NIP </label>
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
                            placeholder="Masukkan Password"
                            <?= isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time() ? 'disabled' : '' ?>>
                        <div class="input-icon text-secondary ms-2">
                            <i class="bi bi-eye-fill toggle-password"></i>
                        </div>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block p-2"
                    <?= isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time() ? 'disabled' : '' ?>>Login</button>
            </form>
            <?php if (isset($_SESSION['lockout_time']) && $_SESSION['lockout_time'] > time()) : ?>
            <div id="countdown" class="text-center text-danger"></div>
            <script>
            var lockoutTime = <?= $_SESSION['lockout_time'] ?>;
            var countdownElement = document.getElementById("countdown");

            function updateCountdown() {
                var remainingTime = lockoutTime - Math.floor(Date.now() / 1000);
                if (remainingTime <= 0) {
                    location.reload();
                }

                var minutes = Math.floor(remainingTime / 60);
                var seconds = remainingTime % 60;
                countdownElement.textContent = "Coba lagi dalam " + minutes + " menit " + seconds + " detik.";

                // Tambahkan kondisi untuk menampilkan form setelah waktu lockout selesai
                if (remainingTime <= 0) {
                    <?php if (!isset($hideForm)) : ?>
                    document.querySelector("form").style.display = "block";
                    <?php endif; ?>
                } else {
                    <?php if (!isset($hideForm)) : ?>
                    document.querySelector("form").style.display = "none";
                    <?php endif; ?>
                }
            }

            setInterval(updateCountdown, 1000);
            </script>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../backend/views/partials/script.php' ?>
<script src="../assets/script/login.js"></script>
<script>
var greetings = ["Datang", "<?= $salam; ?>"];
var index = 0;
var greetingElement = document.getElementById("greeting");

function changeGreeting() {
    var greeting = greetings[index];
    var characters = greeting.split("");
    greetingElement.textContent = "";

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

changeGreeting();
</script>
<?php include 'partials/starter-foot.php' ?>