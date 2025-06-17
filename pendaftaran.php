<?php
session_start();

// Jika pengguna sudah login, alihkan ke halaman utama agar tidak bisa daftar lagi
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

require 'header.php';
?>

<main class="container mx-auto px-4 py-10 max-w-2xl">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-2 text-center">🌄 Siap Menjelajahi Gunung Merbabu?</h2>
        <p class="mb-6 text-sm text-gray-600 text-center">
            Isi formulir di bawah untuk membuat akun. Setelah mendaftar, kamu bisa langsung login dan booking jadwal pendakian.
        </p>

        <?php if(isset($_GET['status'])): ?>
        <div class="text-center p-3 mb-4 rounded-md 
            <?php echo $_GET['status'] == 'sukses' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
            <?php
                if($_GET['status'] == 'gagal_username'){
                    echo "Pendaftaran gagal! Username sudah digunakan.";
                } else if($_GET['status'] == 'gagal_email'){
                    echo "Pendaftaran gagal! Email sudah terdaftar.";
                } else if($_GET['status'] == 'gagal'){
                    echo "Pendaftaran gagal! Terjadi kesalahan.";
                }
            ?>
        </div>
        <?php endif; ?>

        <form id="formDaftar" action="proses_pendaftaran.php" method="POST" class="space-y-4">
            <div>
                <label for="nama_lengkap" class="block font-medium mb-1">Nama Lengkap:</label>
                <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Contoh: Budi Santoso"
                       required class="w-full px-3 py-2 border rounded-md" />
            </div>

            <div>
                <label for="email" class="block font-medium mb-1">Alamat Email:</label>
                <input type="email" id="email" name="email" placeholder="Contoh: budi@email.com"
                       required class="w-full px-3 py-2 border rounded-md" />
            </div>

            <div>
                <label for="username" class="block font-medium mb-1">Username:</label>
                <input type="text" id="username" name="username" placeholder="Contoh: budimerbabu"
                       required class="w-full px-3 py-2 border rounded-md" />
            </div>

            <div>
                <label for="password" class="block font-medium mb-1">Password:</label>
                <input type="password" id="password" name="password" placeholder="Minimal 6 karakter"
                       required class="w-full px-3 py-2 border rounded-md" minlength="6" />
            </div>

            <button type="submit" class="w-full bg-green-700 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-800 transition">
                Daftar Sekarang
            </button>
        </form>
         <p class="text-center mt-6 text-sm text-gray-600">
            Sudah punya akun? <a href="login.php" class="text-blue-600 hover:underline">Login di sini</a>.
        </p>
    </div>
</main>

<?php
require 'footer.php';
?>