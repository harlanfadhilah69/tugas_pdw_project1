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

// Ambil data booking pengguna saat ini (jika ada) untuk ditampilkan di form
$current_booking = null;
$userId = $_SESSION['user_id'];
$stmt = $koneksi->prepare("SELECT tanggal_pendakian, jalur_pendakian FROM booking WHERE id_user = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $current_booking = $result->fetch_assoc();
}
$stmt->close();

// Panggil header
require 'header.php';
?>

<main class="container mx-auto px-6 py-12">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">
            Formulir Booking Pendakian
        </h2>
        <p class="text-center text-gray-600 mb-8">
            Silakan pilih tanggal dan jalur pendakian Anda.
        </p>

        <form action="proses_booking.php" method="POST">
            <div class="space-y-6">
                <div>
                    <label for="tanggal" class="block text-lg font-semibold text-gray-700 mb-2">Pilih Tanggal Pendakian:</label>
                    <input 
                        type="date" 
                        id="tanggal" 
                        name="tanggal" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                        value="<?php echo htmlspecialchars($current_booking['tanggal_pendakian'] ?? ''); ?>"
                        required
                    >
                </div>
                <div>
                    <label for="jalur" class="block text-lg font-semibold text-gray-700 mb-2">Pilih Jalur Pendakian:</label>
                    <select 
                        id="jalur" 
                        name="jalur" 
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                        required
                    >
                        <option value="">-- Pilih Jalur --</option>
                        <?php 
                        $jalur_saat_ini = $current_booking['jalur_pendakian'] ?? '';
                        $jalur_options = ['Selo', 'Wekas', 'Suwanting', 'Thekelan'];
                        foreach ($jalur_options as $option) {
                            $selected = ($jalur_saat_ini == $option) ? 'selected' : '';
                            echo "<option value=\"$option\" $selected>$option</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="text-center mt-8">
                <button type="submit" class="w-full bg-green-700 text-white font-bold py-3 px-8 rounded-lg hover:bg-green-800 transition shadow-lg transform hover:scale-105">
                    Simpan Jadwal Booking
                </button>
            </div>
        </form>
    </div>
</main>

<?php
// Panggil footer
require 'footer.php';
?>