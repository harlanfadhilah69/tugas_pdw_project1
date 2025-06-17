<?php
// Memulai sesi dan memanggil header
// Sesi tetap dimulai untuk konsistensi dan agar menu di header tahu status login pengguna
session_start();
require 'header.php';
?>

<main class="bg-slate-200 py-10 -mt-20 pt-28">
    <section class="container mx-auto px-4 max-w-3xl">
        <div class="bg-white/70 backdrop-blur-md p-8 rounded-lg shadow-2xl border border-white/30">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-center text-gray-800" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
                ✨ Eksplorasi Keindahan Gunung Merbabu
            </h2>

            <img src="img/merbabuview.jpg" alt="Pemandangan Gunung Merbabu dari sabana"
                 class="w-full h-auto max-h-80 object-cover rounded-lg mb-6 shadow-lg border-4 border-white" />

            <div class="text-gray-700 space-y-4 text-lg">
                <p>
                    <strong>Gunung Merbabu</strong> adalah sebuah gunung api strato yang terletak secara geografis di Jawa Tengah, dengan puncaknya yang megah menjulang setinggi 3.145 meter di atas permukaan laut. Dikenal luas karena hamparan sabananya yang mempesona dan pemandangan matahari terbit yang spektakuler, Merbabu menjadi destinasi favorit para pendaki dari berbagai penjuru.
                </p>

                <h3 class="text-2xl font-semibold pt-4 mb-2 border-b pb-2">🔍 Fakta Menarik</h3>
                <ul class="list-disc list-inside space-y-2 pl-4">
                    <li>Secara administratif berada di wilayah empat kabupaten: Magelang, Boyolali, Salatiga, dan Semarang.</li>
                    <li>Nama "Merbabu" berasal dari gabungan kata "meru" (gunung) dan "abu" (abu), yang sering diartikan sebagai "Gunung Abu".</li>
                    <li>Merupakan bagian dari Taman Nasional Gunung Merbabu yang menjadi rumah bagi keanekaragaman hayati yang kaya.</li>
                </ul>

                <h3 class="text-2xl font-semibold pt-4 mb-2 border-b pb-2">🥾 Jalur Pendakian Populer</h3>
                <ol class="list-decimal list-inside space-y-2 pl-4">
                    <li><strong>Selo</strong> – Jalur paling populer dari sisi selatan, terkenal dengan pemandangan sabananya yang tak ada habisnya.</li>
                    <li><strong>Wekas</strong> – Jalur yang lebih pendek namun menanjak curam, melewati hutan yang lebat dan sejuk.</li>
                    <li><strong>Suwanting</strong> – Dianggap sebagai jalur yang paling menantang dengan pemandangan yang sangat indah dan lengkap.</li>
                    <li><strong>Thekelan</strong> – Salah satu jalur tertua yang menawarkan pengalaman pendakian yang lebih sunyi dan alami.</li>
                </ol>

                <p class="pt-4 italic text-center">
                    Untuk pengalaman pendakian yang lebih aman, nyaman, dan tertib, gunakan sistem booking online kami.
                </p>

                <div class="text-center pt-6">
                    <a href="booking.php"
                       class="inline-block bg-green-700 text-white font-bold py-3 px-8 rounded-lg hover:bg-green-800 transition shadow-lg transform hover:scale-105">
                        Mulai Booking Pendakian
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
// Memanggil footer
require 'footer.php';
?>