<?php
// ===================================================================
// BAGIAN 1: LOGIKA PHP
// ===================================================================

// Selalu mulai session di baris paling atas
session_start();
require 'koneksi.php'; // Hubungkan ke database

// 1. Cek status login pengguna, tapi JANGAN redirect.
// Kita hanya simpan statusnya di variabel.
$isLoggedIn = isset($_SESSION['sudah_login']) && $_SESSION['sudah_login'] === true;

// 2. Jika pengguna sudah login, siapkan data dashboard mereka.
if ($isLoggedIn) {
    $userId = $_SESSION['user_id'];
    $nama = $_SESSION['nama_lengkap'];

    // Ambil data booking dari database
    $sql = "SELECT tanggal_pendakian, jalur_pendakian FROM booking WHERE id_user = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    // Siapkan variabel untuk ditampilkan
    if ($result) {
        $tanggal_formatted = date('d F Y', strtotime($result['tanggal_pendakian']));
        $jalur = $result['jalur_pendakian'];
    } else {
        $tanggal_formatted = "Anda belum memiliki jadwal booking.";
        $jalur = "Anda belum memiliki jadwal booking.";
    }
}

// ===================================================================
// BAGIAN 2: TAMPILAN HTML
// ===================================================================

// Panggil header. Header akan otomatis menampilkan menu yang benar.
require 'header.php';
?>

<main class="container mx-auto px-6 py-12">

    <?php if ($isLoggedIn): ?>
    
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
            Selamat Datang Kembali, <?php echo htmlspecialchars($nama); ?>! 👋
        </h2>
        <p class="text-center text-gray-600 mb-8">
            Ini adalah detail booking pendakian Anda di Taman Nasional Gunung Merbabu.
        </p>
        <ul class="space-y-4">
            <li class="bg-gray-100 p-4 rounded-md">
                <strong class="text-blue-600 block text-sm font-semibold">Nama Pendaki:</strong>
                <span class="text-gray-800 text-lg"><?php echo htmlspecialchars($nama); ?></span>
            </li>
            <li class="bg-gray-100 p-4 rounded-md">
                <strong class="text-blue-600 block text-sm font-semibold">Tanggal Pendakian:</strong>
                <span class="text-gray-800 text-lg"><?php echo htmlspecialchars($tanggal_formatted); ?></span>
            </li>
            <li class="bg-gray-100 p-4 rounded-md">
                <strong class="text-blue-600 block text-sm font-semibold">Jalur yang Dipilih:</strong>
                <span class="text-gray-800 text-lg"><?php echo htmlspecialchars($jalur); ?></span>
            </li>
        </ul>
    </div>

    <?php else: ?>

    <div class="relative text-center text-white h-[60vh] flex flex-col justify-center items-center rounded-lg overflow-hidden">
        <div id="carousel" class="carousel-bg"></div>
        
        <div class="relative z-10 bg-black bg-opacity-50 p-10 rounded-lg">
            <h2 class="text-5xl font-extrabold leading-tight">Jelajahi Keindahan Gunung Merbabu</h2>
            <p class="text-xl mt-4 max-w-2xl mx-auto">
                Daftarkan diri Anda untuk melakukan booking pendakian dan nikmati pesona alam yang memukau.
            </p>
            <div class="mt-8 space-x-4">
                <a href="login.php" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">Login</a>
                <a href="pendaftaran.php" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition duration-300">Daftar Sekarang</a>
            </div>
        </div>
    </div>
    
    <?php endif; ?>

</main>

<script>
    const images = [
        'https://images.unsplash.com/photo-1589182373726-e4f658ab50f0?q=80&w=2070&auto=format&fit=crop', // Ganti dengan URL gambar Anda
        'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=2070&auto=format&fit=crop', // Ganti dengan URL gambar Anda
        'https://images.unsplash.com/photo-1593348987823-47963721203b?q=80&w=1932&auto=format&fit=crop'  // Ganti dengan URL gambar Anda
    ];
    let currentImageIndex = 0;
    const carouselElement = document.getElementById('carousel');

    function changeBackgroundImage() {
        if (!carouselElement) return; // Hanya jalankan jika elemen carousel ada
        carouselElement.style.backgroundImage = `url('${images[currentImageIndex]}')`;
        currentImageIndex = (currentImageIndex + 1) % images.length;
    }
    
    // Ganti gambar setiap 5 detik
    if (carouselElement) {
        setInterval(changeBackgroundImage, 5000);
        // Atur gambar pertama saat halaman dimuat
        changeBackgroundImage();
    }
</script>

<?php
// Panggil footer jika ada
require 'footer.php'; 
?>