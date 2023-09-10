<style>
#signal-icon {
    font-size: 19px !important;
}

.icon-koneksi {
    font-size: 19px !important;
}

.animated {
    animation-duration: 1s;
    animation-timing-function: ease-in-out;
}

@keyframes colorChange {
    0% {
        color: red;
    }

    50% {
        color: yellow;
    }

    100% {
        color: green;
    }
}
</style>
<div class="sidebar bg-dark">
    <p class="text-secondary mb-2 mb-4">
        <span id="signal-icon"></span>
        <span id="signal-text"></span>
        <span id="online-status"></span>
    </p>
    <div class="side-bar-head d-flex justify-content-center mb-5">
        <img src="../assets/logo/cilegon.png" class="w-50" alt="">
    </div>
    <ul class="list-unstyled">
        <a class="text-decoration-none orange nav-link p-2 bold-a" href="index">
            <li class="mb-3 mt-2">Beranda</li>
        </a>
        <a class="text-decoration-none orange nav-link p-2 bold-profile" href="profile-admin">
            <li class="mb-3 mt-2">Profile</li>
        </a>
        <a class="text-decoration-none orange nav-link p-2 bold-informasi" href="informasi-web">
            <li class="mb-3 mt-2">Informasi Website</li>
        </a>
        <!-- Spasial -->
        <ul class="list-unstyled mb-3">
            <p class="text-secondary">Data Map Tematik</p>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-b" href="administrasi">
                    Administrasi
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-c" href="prasarana">
                    Prasarana
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-d" href="sarana">
                    Sarana
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-e" href="tematik">
                    Tematik
                </a>
            </li>
        </ul>
        <!-- Tematik -->
        <ul class="list-unstyled mb-3">
            <p class="text-secondary">Data Map Rencana</p>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-f" href="rencana">
                    Rencana
                </a>
            </li>
        </ul>
        <!-- Data pokok -->
        <ul class="list-unstyled mb-3">
            <p class="text-secondary">Data Tabulasi</p>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-p" href="data-administrasi">
                    Data Administrasi
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-g" href="data-sarana">
                    Data Sarana
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-h" href="data-prasarana">
                    Data Prasarana
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-i" href="data-tematik">
                    Data Tematik
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-j" href="data-rencana">
                    Data Rencana
                </a>
            </li>
        </ul>
        <!-- Referensi -->
        <ul class="list-unstyled mb-3">
            <p class="text-secondary">Data Umum</p>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-k" href="data-wilayah">
                    Data Wilayah
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-l" href="data-skpd">
                    Data SKPD
                </a>
            </li>
        </ul>
        <!-- Publikasi -->
        <ul class="list-unstyled mb-3">
            <p class="text-secondary">Data Publikasi</p>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-m" href="data-publikasi">
                    Data Publikasi
                </a>
            </li>
        </ul>
        <!-- Layanan -->
        <ul class="list-unstyled mb-3">
            <p class="text-secondary">Infografis</p>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-n" href="data-kemantapan-jalan">
                    Kemantapan Jalan
                </a>
            </li>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-o" href="data-kemantapan-drainase">
                    Kemantapan Drainase
                </a>
            </li>
        </ul>
        <ul class="list-unstyled mb-3">
            <p class="text-secondary">Kritik & Saran</p>
            <li class="ms-3">
                <a class="text-decoration-none orange nav-link p-2 bold-q" href="kritik-saran">
                    Klik Disini <i class="ms-1 fa-solid fa-hand-point-left"></i>
                </a>
            </li>
        </ul>
        <a class="register-button text-decoration-none text-dark bg-orange nav-link p-1 text-center mt-3"
            href="register-admin">
            <li class="mb-3 mt-2"><i class="bi bi-person-plus me-2 fw-bold"></i>Registrasi admin baru </li>
        </a>
        <a href="../auth/logout" class="btn btn-danger p-2 mt-2"><i class="fa-solid fa-right-from-bracket"></i>
            Logout</a>
        <a href="admin-setting" class="btn btn-warning p-2 mt-2"><i class="fa-solid fa-gear"></i> Setting</a>
    </ul>
    <p class="text-secondary mb-2 mt-3"><span class="bold">Version</span> 1.0</p>
</div>