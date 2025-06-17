<?php
// Memulai sesi dan memanggil header
// Sesi tetap dimulai untuk konsistensi dan agar menu di header tahu status login pengguna
session_start();
require 'header.php';
?>

<main class="text-white bg-slate-400 py-10">
    <section class="relative z-10 container mx-auto px-4 max-w-3xl">
        <div class="bg-white/20 backdrop-blur-sm p-8 rounded-lg">
            <h2 class="text-2xl md:text-3xl font-semibold mb-6 text-center text-white">
                ✨ Eksplorasi Keindahan Gunung Merbabu
            </h2>

            <img src="img/merbabuview.jpg" alt="Gunung Merbabu"
                 class="w-full max-h-72 object-cover rounded-lg mb-6 shadow-md" />

            <p class="mb-4">
                <strong>Gunung Merbabu</strong> adalah gunung berapi di Jawa Tengah dengan ketinggian 3.145 mdpl.
                Merbabu menawarkan jalur sabana yang luas dan pemandangan sunrise yang memukau.
            </p>

            <h3 class="text-xl font-semibold mb-2">🔍 Fakta Menarik</h3>
            <ul class="list-disc list-inside mb-6 space-y-1">
                <li>Berada di kawasan Taman Nasional Gunung Merbabu.</li>
                <li>Nama "Merbabu" berarti "Gunung Wanita Tua".</li>
                <li>Tersedia beberapa jalur pendakian menantang dan indah.</li>
            </ul>

            <h3 class="text-xl font-semibold mb-2">🥾 Jalur Pendakian Populer</h3>
            <ol class="list-decimal list-inside mb-6 space-y-1">
                <li><strong>Selo</strong> – Jalur populer dan ramah pemula.</li>
                <li><strong>Wekas</strong> – Melalui hutan lebat dan sejuk.</li>
                <li><strong>Suwanting</strong> – Tantangan bagi pendaki berpengalaman.</li>
                <li><strong>Thekelan</strong> – Jalur alami, sunyi, dan eksotis.</li>
            </ol>

            <p class="mb-6">Gunakan sistem booking online untuk pendakian yang lebih tertib dan nyaman.</p>

            <div class="text-center">
                <a href="pendaftaran.php"
                   class="inline-block bg-green-700 text-white py-2 px-5 rounded hover:bg-green-800 transition">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>
</main>

<?php
// Memanggil footer
require 'footer.php';
?>