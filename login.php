<?php
// Mulai sesi di setiap halaman yang membutuhkan informasi login
session_start();

// Panggil header. Navigasi di header akan otomatis menyesuaikan status login.
require 'header.php';
?>

<main class="container mx-auto px-4 py-10 max-w-xl">

    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="bg-white p-8 rounded-lg shadow-md text-center">
            <h2 class="text-2xl font-bold text-green-700 mb-4">
                Anda Sudah Login
            </h2>
            <p class="mb-6 text-gray-700">
                Anda login sebagai <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>.
            </p>
            <a href="booking.php" class="inline-block w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition font-semibold mb-2">
                Lanjutkan ke Halaman Booking
            </a>
            <a href="logout.php" class="inline-block w-full bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 transition font-semibold">
                Logout
            </a>
        </div>

    <?php else: ?>
        <h2 class="text-2xl font-semibold mb-2 text-center">👋 Selamat Datang Kembali!</h2>
        <p class="mb-6 text-sm text-gray-600 text-center">
            Silakan masukkan username dan password Anda untuk melanjutkan.
        </p>
        
        <?php if(isset($_GET['pesan'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-center" role="alert">
            <?php
                if($_GET['pesan'] == 'gagal'){
                    echo "Login gagal! Username atau password salah.";
                } else if($_GET['pesan'] == 'harus_login'){
                    echo "Anda harus login untuk mengakses halaman tersebut.";
                } else if($_GET['pesan'] == 'logout_sukses'){
                    echo "Anda telah berhasil logout.";
                }
            ?>
        </div>
        <?php endif; ?>

        <form id="formLogin" action="proses_login.php" method="POST" class="bg-white p-8 rounded-lg shadow-md space-y-4">
            <div>
                <label for="username" class="block font-medium mb-1">Username:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda"
                       required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
            </div>

            <div>
                <label for="password" class="block font-medium mb-1">Password:</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda"
                       required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
            </div>

            <button type="submit" class="w-full bg-green-700 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-800 transition">
                Login
            </button>
        </form>

        <p class="text-center mt-6 text-sm text-gray-600">
            Belum punya akun? <a href="pendaftaran.php" class="text-blue-600 hover:underline">Daftar di sini</a>.
        </p>

    <?php endif; ?>

</main>

<?php
// Panggil footer
require 'footer.php';
?>