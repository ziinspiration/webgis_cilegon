<style>
    #navbarToggler {
        border: none !important;
        background-color: transparent !important;
    }

    .bi-x-circle:hover {
        color: red !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand p-3" href="#">
            <img src="assets/logo/cilegon.png" alt="Bootstrap" width="85" height="85">
        </a>
        <button id="navbarToggler" class="custom-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i id="navbarIcon" class="bi bi-three-dots-vertical"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mb-2" href="#" id="referensiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Referensi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="referensiDropdown">
                        <li><a class="dropdown-item" href="wilayah">Wilayah</a></li>
                        <li><a class="dropdown-item border-bottom" href="skpd">SKPD</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="datapokok">Data pokok</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mb-2" href="#" id="petaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Peta
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="petaDropdown">
                        <li><a class="dropdown-item" href="mapTematik">Tematik</a></li>
                        <li><a class="dropdown-item border-bottom" href="mapSpasial">Spasial</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle mb-2" href="#" id="layananDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                        <li><a class="dropdown-item border-bottom" href="kemantapan-jalan">Kemantapan Jalan</a></li>
                        <li><a class="dropdown-item border-bottom" href="kemantapan-drainase">Kemantapan Drainase</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="publikasi">Publikasi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>