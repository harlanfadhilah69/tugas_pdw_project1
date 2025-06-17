<?php
// Memulai sesi untuk konsistensi header
session_start();
// Memanggil header
require 'header.php';
?>

<main class="bg-gray-100 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto bg-white p-8 md:p-10 rounded-xl shadow-lg">
            
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-4">
                Hubungi Kami
            </h2>
            <p class="text-center text-gray-500 mb-10">
                Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi contact person kami di bawah ini.
            </p>

            <div class="border-t border-gray-200 pt-8">
                <div class="space-y-6 text-lg text-gray-700">
                    
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-semibold text-gray-500">Nama</div>
                            <div class="font-bold text-gray-900">Gagat Cahya Wijatmiko</div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-semibold text-gray-500">Email</div>
                            <a href="mailto:gagatadmin@gmail.com" class="font-bold text-blue-600 hover:underline">gagatadmin@gmail.com</a>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-semibold text-gray-500">No. Telp</div>
                            <div class="font-bold text-gray-900">0854-3221-4066</div>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-green-100 text-green-700 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-semibold text-gray-500">Alamat</div>
                            <div class="font-bold text-gray-900">Kantor Taman Nasional Gunung Merbabu<br>Jl. Merbabu Raya No. 123, Kecamatan Selo,<br>Kabupaten Boyolali, Jawa Tengah, 57363</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>

<?php
// Memanggil footer
require 'footer.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">