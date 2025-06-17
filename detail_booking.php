<?php
// Selalu mulai session di baris paling atas
session_start();

// Keamanan: Pastikan hanya pengguna yang sudah login yang bisa mengakses halaman ini
if (!isset($_SESSION['sudah_login'])) {
    header('Location: login.php');
    exit();
}

// Hubungkan ke database
require 'koneksi.php';

// Ambil data booking berdasarkan ID user dari session
$userId = $_SESSION['user_id'];
$nama = $_SESSION['nama_lengkap'];

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

// Panggil header
require 'header.php';
?>

<main class="container mx-auto px-6 py-12">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
            Selamat Datang, <?php echo htmlspecialchars($nama); ?>! 👋
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
</main>

<?php
// Panggil footer
require 'footer.php';
?>