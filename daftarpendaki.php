<?php
// Memulai sesi dan memanggil header
session_start();
require 'header.php';

// Memanggil file koneksi ke database
require 'koneksi.php';
?>

<main class="max-w-6xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-center text-green-700">Daftar Pendaki yang Sudah Booking</h2>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-green-100 text-green-800">
                <tr>
                    <th class="py-3 px-4 border">No</th>
                    <th class="py-3 px-4 border">Nama Lengkap</th>
                    <th class="py-3 px-4 border">Alamat Email</th>
                    <th class="py-3 px-4 border">Username</th>
                    <th class="py-3 px-4 border">Tanggal Pendakian</th>
                    <th class="py-3 px-4 border">Jalur Pendakian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk menggabungkan tabel booking dan pendaftaran
                // Kita menggunakan INNER JOIN untuk mengambil data terkait dari kedua tabel
                $sql = "SELECT 
                            p.nama_lengkap, 
                            p.email, 
                            p.username, 
                            b.tanggal_pendakian, 
                            b.jalur_pendakian 
                        FROM 
                            booking AS b
                        INNER JOIN 
                            pendaftaran AS p ON b.nama_lengkap = p.nama_lengkap
                        ORDER BY 
                            b.tanggal_pendakian ASC";

                $result = $koneksi->query($sql);

                // Cek apakah ada data yang ditemukan
                if ($result->num_rows > 0) {
                    $no = 1; // Variabel untuk penomoran
                    // Looping untuk menampilkan setiap baris data
                    while($row = $result->fetch_assoc()) {
                        echo "<tr class='hover:bg-green-50'>";
                        echo "<td class='py-2 px-4 border text-center'>" . $no++ . "</td>";
                        // Menggunakan htmlspecialchars untuk keamanan dari serangan XSS
                        echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                        echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td class='py-2 px-4 border'>" . date('d F Y', strtotime($row['tanggal_pendakian'])) . "</td>"; // Format tanggal
                        echo "<td class='py-2 px-4 border'>" . htmlspecialchars($row['jalur_pendakian']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Tampilkan pesan ini jika tidak ada data booking
                    echo "<tr><td colspan='6' class='text-center py-4'>Belum ada data booking yang tersedia.</td></tr>";
                }

                // Menutup koneksi database
                $koneksi->close();
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php
// Memanggil footer
require 'footer.php';
?>