<?php include '../backend/views/partials/starter-head.php'; ?>
<?php include '../backend/views/partials/alert-tambah-data.php'; ?>
<style>
    .swal2-popup {
        z-index: 9999 !important;
    }
</style>
<?php
if (isset($_POST["update"])) {
    $current_password = $_POST["current_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];

    // Ambil password lama dari database
    $query = "SELECT password FROM admin WHERE id = $admin_id";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    // Periksa apakah password lama cocok
    if (password_verify($current_password, $admin["password"])) {
        // Periksa apakah konfirmasi password baru sesuai
        if ($new_password === $confirm_password) {
            // Hash password baru sebelum menyimpan ke database
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update password baru ke dalam database
            $update_query = "UPDATE admin SET password = '$hashed_password' WHERE id = $admin_id";
            mysqli_query($conn, $update_query);

            echo '<script>
    Swal.fire({
        position: "center-center",
        icon: "success",
        title: "Sukses",
        text: "Kata sandi berhasil diperbarui.",
        showConfirmButton: false,
        timer: 3500
    }).then(function() {
        window.location.href = "logout"; 
    });
</script>';
        } else {
            echo '<script>
                Swal.fire({
                    position: "center-center",
                    icon: "error",
                    title: "Oops :(",
                    text: "Konfirmasi kata sandi tidak sesuai.",
                    showConfirmButton: false,
                    timer: 3500
                });
            </script>';
        }
    } else {
        echo '<script>
            Swal.fire({
                position: "center-center",
                icon: "error",
                title: "Oops :(",
                text: "Kata sandi lama tidak sesuai.",
                showConfirmButton: false,
                timer: 3500
            });
        </script>';
    }
}
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6">
            <h2 class="text-center orange mt-5 mb-5">Form update password</h2>
            <form action="" method="post" class="card p-4 bg-dark rounded-4">
                <div class="form-group mb-3">
                    <label for="current_password" class="orange mb-1">Current password</label>
                    <div class="d-flex align-items-center">
                        <i class="bi icon bi-lock-fill me-1 text-secondary"></i>
                        <input type="password" class="form-control pt-1 pb-1" id="current_password" name="current_password" placeholder="Masukkan Password Lama" required>
                        <div class="input-icon text-secondary ms-2">
                            <i class="bi bi-eye-fill toggle-password" id="togglePassword"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="new_password" class="orange mb-1">New password</label>
                    <div class="d-flex align-items-center">
                        <i class="bi icon bi-lock-fill me-1 text-secondary"></i>
                        <input type="password" class="form-control pt-1 pb-1" id="new_password" name="new_password" placeholder="Masukkan Password Baru" required>
                    </div>
                    <span id="password-strength" class=""></span>
                </div>
                <div class="form-group mb-5">
                    <label for="confirm_password" class="orange mb-1">Confirm password</label>
                    <div class="d-flex align-items-center">
                        <i class="bi icon bi-lock-fill me-1 text-secondary"></i>
                        <input type="text" class="form-control pt-1 pb-1" id="confirm_password" name="confirm_password" placeholder="Konfirmasi Password Baru" required>
                    </div>
                    <span id="password-error" class="text-danger"></span>
                </div>
                <button type="submit" name="update" class="btn btn-primary btn-block p-2">Update</button>
            </form>
        </div>
    </div>
</div>
<?php include '../backend/views/partials/script.php' ?>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const passwordInput = document.querySelector("#current_password");

    togglePassword.addEventListener("click", function() {
        if (passwordInput.getAttribute("type") === "password") {
            passwordInput.setAttribute("type", "text");
            togglePassword.classList.remove("bi-eye-fill");
            togglePassword.classList.add("bi-eye-slash-fill");
        } else {
            passwordInput.setAttribute("type", "password");
            togglePassword.classList.remove("bi-eye-slash-fill");
            togglePassword.classList.add("bi-eye-fill");
        }
    });
</script>
<script>
    function checkPasswordMatch() {
        var password = document.getElementById("new_password").value;
        var confirm_password = document.getElementById("confirm_password").value;
        var errorElement = document.getElementById("password-error");

        if (password !== confirm_password) {
            errorElement.textContent = "Konfirmasi password belum sesuai";
            return false;
        } else {
            errorElement.textContent = "";
            return true;
        }
    }

    // Tambahkan event listener untuk memanggil fungsi checkPasswordMatch saat konfirmasi password berubah
    document.getElementById("confirm_password").addEventListener("input", checkPasswordMatch);

    document.getElementById("new_password").addEventListener("input", function() {
        checkPasswordMatch(); // Panggil fungsi checkPasswordMatch saat input password baru berubah

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
<?php include '../backend/views/partials/starter-foot.php' ?>