<?php include 'partials/starter-head.php' ?>
<?php
date_default_timezone_set('Asia/Jakarta'); // Mengatur zona waktu sesuai kebutuhan

$jam = date('H'); // Mendapatkan jam saat ini (format 24 jam)

if ($jam >= 3 && $jam < 10) {
    $salam = 'Selamat Pagi';
} elseif ($jam >= 10 && $jam < 15) {
    $salam = 'Selamat Siang';
} elseif ($jam >= 15 && $jam < 18) {
    $salam = 'Selamat Sore';
} else {
    $salam = 'Selamat Malam';
}

?>
<?php include 'partials/nav.php' ?>
<div class="container-fluid p-0">
    <div class="hero" id="hero">
        <div class="hero-content">
            <h2 class="text-light"><span id="greeting" class="text-light"></span> <br> Di Website <span style="color: orange;">BAPPEDA KOTA CILEGON</span></h2>
        </div>
    </div>
</div>

<script>
    var greetings = ["Selamat Datang", "<?= $salam; ?>"];
    var index = 0;
    var greetingElement = document.getElementById("greeting");
    var heroElement = document.getElementById("hero");
    var backgrounds = ["assets/index/hero-1.jpeg",
        "assets/index/hero-2.jpg"
    ]; // Ganti dengan path gambar yang Anda inginkan
    var backgroundIndex = 0;

    function changeGreeting() {
        var greeting = greetings[index];
        var characters = greeting.split("");

        var interval = setInterval(function() {
            greetingElement.textContent += characters.shift();

            if (characters.length === 0) {
                clearInterval(interval);
                setTimeout(function() {
                    greetingElement.textContent = "";
                    index = (index + 1) % greetings.length;
                    changeGreeting();
                }, 2500);
            }
        }, 150);
    }

    function changeBackground() {
        heroElement.style.backgroundImage = "url('" + backgrounds[backgroundIndex] + "')";
        heroElement.style.transition = "background-image 1s ease-in-out"; // Tambahkan efek transisi
        backgroundIndex = (backgroundIndex + 1) % backgrounds.length;
    }

    changeGreeting();
    changeBackground();
    setInterval(changeBackground, 4000);
</script>
<?php include 'partials/footer.php' ?>
<?php include 'partials/starter-foot.php' ?>