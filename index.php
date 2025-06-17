<?php
// Hanya perlu memulai session untuk header dan memanggil file yang dibutuhkan
session_start();
require 'koneksi.php';
require 'header.php';
?>

<main class="-mt-24"> <div class="relative w-full h-screen flex flex-col text-white overflow-hidden">
        
        <div id="hero-bg-1" class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 ease-in-out"></div>
        <div id="hero-bg-2" class="absolute inset-0 w-full h-full bg-cover bg-center transition-opacity duration-1000 ease-in-out opacity-0"></div>
        
        <div class="absolute inset-0 bg-black opacity-30"></div>
        
            <div class="relative z-10 w-full px-4 text-center" style="padding-top: 35vh;">
                <div> <h1 class="text-5xl md:text-7xl font-bold tracking-tight" style="text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);">
                    Jelajahi Keindahan Gunung Merbabu
                </h1>
                <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto" style="text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);">
                    Temukan keajaiban alam, jalur yang menantang, dan pemandangan matahari terbit yang tak terlupakan.
                </p>
                <div class="mt-8">
                    <a href="tentang.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300 shadow-lg transform hover:scale-105">
                        Mulai Jelajahi
                    </a>
                </div>
            </div>
        </div>

        <div class="relative z-10 w-full mt-auto mb-8 px-4">
            <div class="max-w-4xl mx-auto p-4 bg-black bg-opacity-30 backdrop-blur-sm rounded-lg">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="h-24 md:h-32 bg-cover bg-center rounded-md" style="background-image: url('img/gambar1.jpg');"></div>
                    <div class="h-24 md:h-32 bg-cover bg-center rounded-md" style="background-image: url('img/gambar2.jpg');"></div>
                    <div class="h-24 md:h-32 bg-cover bg-center rounded-md" style="background-image: url('img/gambar3.jpg');"></div>
                    <div class="h-24 md:h-32 bg-cover bg-center rounded-md" style="background-image: url('img/gambar4.jpg');"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const bgElement1 = document.getElementById('hero-bg-1');
    const bgElement2 = document.getElementById('hero-bg-2');
    if (bgElement1 && bgElement2) {
        const images = [ 'img/gambar1.jpg', 'img/gambar2.jpg', 'img/gambar3.jpg', 'img/gambar4.jpg' ];
        let currentImageIndex = 0;
        let isBg1Active = true;
        function crossfade() {
            const activeEl = isBg1Active ? bgElement1 : bgElement2;
            const passiveEl = isBg1Active ? bgElement2 : bgElement1;
            currentImageIndex = (currentImageIndex + 1) % images.length;
            passiveEl.style.backgroundImage = `url('${images[currentImageIndex]}')`;
            passiveEl.style.opacity = 1;
            activeEl.style.opacity = 0;
            isBg1Active = !isBg1Active;
        }
        bgElement1.style.backgroundImage = `url('${images[0]}')`;
        setInterval(crossfade, 4000);
    }
</script>

<?php
require 'footer.php'; 
?>