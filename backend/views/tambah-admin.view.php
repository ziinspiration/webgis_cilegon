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

<?php include 'views/partials/starter-head.php'; ?>
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
            <?php if (isset($message)) : ?>
                <div class="alert text-center p-4 mb-4 alert-<?= $message['type'] ?> alert-dismissible fade show mt-3" role="alert">
                    <?= $message['text'] ?>
                    <button type="button" class="btn-close p-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <form class="card w-100 p-5 mb-5 m-auto bg-dark" action="" method="post">
                <input type="hidden" name="foto_profile" value="">
                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama_pegawai" class="form-label user-label orange ps-1 pe-1">Nama pegawai</label>
                    <input type="text" name="nama_pegawai" class="form-control username-input border-orange" id="nama_pegawai" placeholder="Masukkan Nama Pegawai" required />
                </div>
                <!-- NIK -->
                <div class="mb-3">
                    <label for="nik" class="form-label user-label orange ps-1 pe-1">NIP</label>
                    <input type="text" name="nik" class="form-control username-input border-orange" id="nik" placeholder="Masukkan NIP" required />
                    <!-- Tambahkan span untuk menampilkan peringatan -->
                    <span id="nik-error" class="text-danger"></span>
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label password-label orange ps-1 pe-1">Password</label>
                    <input type="password" name="password" class="form-control password-input border-orange" id="password" placeholder="Masukkan Password" required />
                    <span id="password-strength" class=""></span>
                </div>
                <!-- Repeat Password -->
                <div class="mb-3">
                    <label for="password2" class="form-label password-label orange ps-1 pe-1">Konfirmasi
                        Password</label>
                    <input type="text" name="password2" class="form-control password-input border-orange" id="password2" placeholder="Konfirmasi Password" required />
                    <span id="password-error" class="text-danger"></span>
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


    // Tambahkan fungsi untuk memeriksa kesesuaian password dan konfirmasi password
    function checkPasswordMatch() {
        var password = document.getElementById("password").value;
        var password2 = document.getElementById("password2").value;
        var errorElement = document.getElementById("password-error");

        if (password !== password2) {
            errorElement.textContent = "Konfirmasi password belum sesuai";
            return false;
        } else {
            errorElement.textContent = "";
            return true;
        }
    }

    // Tambahkan event listener untuk memanggil fungsi checkPasswordMatch saat konfirmasi password berubah
    document.getElementById("password2").addEventListener("input", checkPasswordMatch);


    document.getElementById("nik").addEventListener("input", function() {
        var nikInput = this.value;
        var errorElement = document.getElementById("nik-error");

        // Lakukan pengecekan dengan regex untuk memastikan input hanya angka
        if (!/^\d+$/.test(nikInput)) {
            errorElement.textContent = "NIP hanya boleh berisi angka";
        } else {
            errorElement.textContent = "";
        }
    });

    // Tambahkan event listener untuk menampilkan status keamanan password secara live
    document.getElementById("password").addEventListener("input", function() {
        var passwordInput = this.value;
        var passwordStrengthElement = document.getElementById("password-strength");

        // Lakukan pengecekan untuk menentukan status keamanan password
        if (passwordInput === "") {
            passwordStrengthElement.textContent = ""; // Hilangkan teks jika input kosong
        } else if (/^[0-9]+$/.test(passwordInput) || /^[a-zA-Z]+$/.test(passwordInput)) {
            passwordStrengthElement.textContent = "Status keamanan: Tidak kuat";
            passwordStrengthElement.classList.remove("text-success");
            passwordStrengthElement.classList.remove("text-primary");
            passwordStrengthElement.classList.add("text-danger");
        } else if (/^[a-zA-Z0-9]+$/.test(passwordInput)) {
            passwordStrengthElement.textContent = "Status keamanan: Sedang";
            passwordStrengthElement.classList.remove("text-success");
            passwordStrengthElement.classList.remove("text-danger");
            passwordStrengthElement.classList.add("text-primary");
        } else {
            passwordStrengthElement.textContent = "Status keamanan: Kuat";
            passwordStrengthElement.classList.remove("text-primary");
            passwordStrengthElement.classList.remove("text-danger");
            passwordStrengthElement.classList.add("text-success");
        }
    });
</script>
<?php include 'views/partials/starter-foot.php'; ?>