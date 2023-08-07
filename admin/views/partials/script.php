<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.1/dist/leaflet.markercluster.js"></script>
<script src="../assets/sweetalert/cdn.jsdelivr.net_npm_sweetalert2@11_dist_sweetalert2.min.js"></script>
<script src="script/login.js"></script>
<script>
    var oldSignalStrength = -1; // Penyimpanan kekuatan sinyal sebelumnya

    // Fungsi untuk memeriksa status koneksi dan memperbarui tampilan
    function checkOnlineStatus() {
        if (navigator.onLine) {
            // Perangkat terhubung ke internet
            updateSignalStatus(oldSignalStrength, true);
        } else {
            // Perangkat tidak terhubung ke internet
            displayNoSignal();
        }
    }

    // Fungsi untuk memperbarui tampilan status sinyal
    function updateSignalStatus(signalStrength, isConnected) {
        var signalIcon = document.getElementById("signal-icon");
        var signalText = document.getElementById("signal-text");
        var onlineStatus = document.getElementById("online-status");

        signalIcon.innerHTML = ''; // Hapus ikon sebelumnya

        if (isConnected) {
            if (signalStrength <= 50) {
                signalIcon.innerHTML = '<i class="bi bi-reception-4" style="color: green;"></i>';
                signalText.textContent = "Kuat";
            } else if (signalStrength <= 100) {
                signalIcon.innerHTML = '<i class="bi bi-reception-2" style="color: yellow;"></i>';
                signalText.textContent = "Sedang";
            } else {
                signalIcon.innerHTML = '<i class="bi bi-reception-1" style="color: red;"></i>';
                signalText.textContent = "Lemah";
            }
            onlineStatus.innerHTML = '| <i class="fa-solid fa-circle" style="color: green;"></i> Online';
        } else {
            signalIcon.innerHTML = '<i class="bi bi-dash-circle" style="color: gray;"></i>';
            signalText.textContent = "No Signal";
            onlineStatus.innerHTML = '| <i class="fa-solid fa-circle" style="color: gray;"></i> Offline';
        }

        // Animasi perubahan sinyal
        if (oldSignalStrength !== -1) {
            animateSignalChange(signalStrength);
        }
        oldSignalStrength = signalStrength;
    }

    // Fungsi untuk animasi perubahan sinyal
    function animateSignalChange(newSignalStrength) {
        var signalIcon = document.getElementById("signal-icon");
        var signalText = document.getElementById("signal-text");

        signalIcon.style.opacity = 0;
        signalText.style.opacity = 0;

        setTimeout(function() {
            signalIcon.style.opacity = 1;
            signalText.style.opacity = 1;
            updateSignalStatus(newSignalStrength, true);
        }, 300);
    }

    // Fungsi untuk menampilkan status offline
    function displayNoSignal() {
        var signalIcon = document.getElementById("signal-icon");
        var signalText = document.getElementById("signal-text");
        var onlineStatus = document.getElementById("online-status");

        signalIcon.innerHTML = '<i class="bi bi-reception-0 icon-koneksi" style="color: gray;"></i>';
        signalText.textContent = "No signal";
        onlineStatus.innerHTML = '| <i class="fa-solid fa-circle" style="color: gray;"></i> Offline';
    }

    // Panggil fungsi untuk memeriksa status koneksi setiap beberapa detik
    setInterval(checkOnlineStatus, 5000); // Ganti dengan interval yang Anda inginkan (dalam milidetik)
    checkOnlineStatus(); // Panggil fungsi pertama kali saat halaman dimuat
</script>