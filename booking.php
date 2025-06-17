<?php
// Memulai sesi untuk memeriksa status login
session_start();

// Cek apakah pengguna sudah login. Jika belum, alihkan ke halaman login.
if (!isset($_SESSION['user_id'])) {
    // Redirect ke login.php dengan pesan error
    header('Location: login.php?pesan=harus_login');
    exit(); // Pastikan tidak ada kode lain yang dieksekusi setelah redirect
}

// Jika sudah login, panggil header
require 'header.php';
?>

<main class="container mx-auto px-4 py-10">
    <div class="bg-white p-8 rounded-lg shadow-md max-w-xl mx-auto">
        
        <div class="mb-6 pb-4 border-b">
            <h2 class="text-2xl font-bold">Formulir Booking Pendakian</h2>
            <p class="text-gray-600">Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></strong>! Silakan isi detail pendakian Anda.</p>
        </div>

        <form id="formBooking" action="proses_booking.php" method="POST" class="space-y-4">
            
            <div>
                <label for="nama" class="block font-semibold mb-1">Nama Lengkap:</label>
                <input 
                    type="text" 
                    id="nama" 
                    name="nama" 
                    value="<?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?>" 
                    required 
                    class="w-full px-3 py-2 border rounded-md bg-gray-100" 
                    readonly 
                />
            </div>

            <div>
                <label for="tanggal" class="block font-semibold mb-1">Tanggal Pendakian:</label>
                <input 
                    type="date" 
                    id="tanggal" 
                    name="tanggal" 
                    required 
                    class="w-full px-3 py-2 border rounded-md" 
                    min="<?php echo date('Y-m-d'); ?>" 
                />
            </div>

            <div>
                <label for="jalur" class="block font-semibold mb-1">Pilih Jalur Pendakian:</label>
                <select id="jalur" name="jalur" required class="w-full px-3 py-2 border rounded-md">
                    <option value="">-- Pilih Jalur --</option>
                    <option value="Selo">Selo</option>
                    <option value="Wekas">Wekas</option>
                    <option value="Suwanting">Suwanting</option>
                    <option value="Thekelan">Thekelan</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-700 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-800 transition duration-200">
                Booking Sekarang
            </button>
        </form>
    </div>
</main>

<?php
// Memanggil footer
require 'footer.php';
?>