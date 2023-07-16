<?php include 'views/partials/starter-head.php' ?>
<div class="container-fluid">
    <form action="" method="post">
        <!-- Nama -->
        <div class="mb-3">
            <label for="nama_pegawai" class="form-label ms-3 user-label text-primary ps-1 pe-1">Nama pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control username-input border border-3 border-primary" id="nama_pegawai" placeholder="Masukkan nama_pegawai" />
        </div>
        <!-- NIK -->
        <div class="mb-3">
            <label for="nik" class="form-label ms-3 user-label text-primary ps-1 pe-1">nik</label>
            <input type="text" name="nik" class="form-control username-input border border-3 border-primary" id="nik" placeholder="Masukkan nik" />
        </div>
        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label password-label ms-3 text-primary ps-1 pe-1">Password</label>
            <input type="password" name="password" class="form-control password-input border border-3 border-primary" id="password" placeholder="Masukkan Password" />
        </div>
        <!-- Repeat Password -->
        <div class="mb-3">
            <label for="password2" class="form-label password-label ms-3 text-primary ps-1 pe-1">Konfirmasi
                Password</label>
            <input type="text" name="password2" class="form-control password-input border border-3 border-primary" id="password2" placeholder="Masukkan Password" />
        </div>
        <button type="submit" name="register" class="btn btn-login btn-primary">
            Daftar
        </button>
    </form>
</div>
<?php include 'views/partials/starter-foot.php' ?>