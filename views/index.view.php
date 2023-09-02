<?php include 'partials/starter-head.php' ?>
<?php
date_default_timezone_set('Asia/Jakarta');

$jam = date('H');

if ($jam >= 3 && $jam < 10) {
    $salam = 'Selamat Pagi';
} elseif ($jam >= 10 && $jam < 15) {
    $salam = 'Selamat Siang';
} elseif ($jam >= 15 && $jam < 18) {
    $salam = 'Selamat Sore';
} else {
    $salam = 'Selamat Malam';
}

$jamSekarang = date('H:i:s');

?>
<?php include 'partials/nav.php' ?>

<div class="container-fluid p-0">
    <div class="running-text">
        <div class="running-left text-center bg-orange text-dark">
            <p id="clock"></p>
        </div>
        <div class="running-right bg-dark text-light">
            <marquee behavior="scroll" direction="left">
                <?php foreach ($getmarquee as $marque) : ?>
                <?= $marque['informasi']; ?>
                <i class="fa-solid fa-circle orange ms-4 me-4"></i>
                <?php endforeach; ?>
            </marquee>
        </div>
    </div>
    <div class="hero" id="hero">
        <div class="hero-content">
            <h2 class="text-light"><span id="greeting" class="text-light"></span> <br> Di Website <span
                    style="color: orange;">BAPPELITBANG KOTA CILEGON</span></h2>
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
];
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

// Update jam
function updateClock() {
    const serverTime = new Date("<?php echo date('Y-m-d H:i:s'); ?>");
    const clientTime = new Date();
    const timeDifference = serverTime.getTime() - clientTime.getTime();

    setInterval(() => {
        const currentTime = new Date(new Date().getTime() + timeDifference);
        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        const seconds = currentTime.getSeconds().toString().padStart(2, '0');
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }, 1000);
}

window.onload = updateClock;
</script>
<?php include 'partials/footer.php' ?>
<?php include 'partials/script.php' ?>
<?php include 'partials/starter-foot.php' ?>