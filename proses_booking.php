<?php
session_start();
require 'koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

// Cek apakah data dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // ======================== PERUBAHAN INTI ========================
    // Ambil data dari sesi (ID dan Nama) dan dari form
    $userId = $_SESSION['user_id'];               // <-- AMBIL ID USER dari session (PALING PENTING)
    $nama_lengkap = $_SESSION['nama_lengkap'];    // <-- Ambil nama lengkap dari sesi
    $tanggal_pendakian = $_POST['tanggal'];
    $jalur = $_POST['jalur'];
    // ==============================================================

    // Validasi sederhana
    if (empty($tanggal_pendakian) || empty($jalur)) {
        die("Data tidak lengkap. Silakan isi semua field.");
    }

    // ======================== PERUBAHAN INTI ========================
    // Query INSERT sekarang menyertakan kolom id_user
    $sql = "INSERT INTO booking (id_user, nama_lengkap, tanggal_pendakian, jalur_pendakian) VALUES (?, ?, ?, ?)";
    // ==============================================================
    
    $stmt = $koneksi->prepare($sql);

    if ($stmt === false) {
        die("Gagal menyiapkan statement: " . $koneksi->error);
    }
    
    // ======================== PERUBAHAN INTI ========================
    // Mengikat parameter ke statement.
    // Tipe data diubah menjadi "isss" (integer, string, string, string) dan $userId ditambahkan
    $stmt->bind_param("isss", $userId, $nama_lengkap, $tanggal_pendakian, $jalur);
    // ==============================================================
    
    // Eksekusi statement
    if ($stmt->execute()) {
        // Jika berhasil, alihkan ke halaman utama dengan pesan sukses
        header('Location: index.php?status=booking_sukses');
    } else {
        // Jika gagal, tampilkan error
        echo "Error saat menyimpan booking: " . $stmt->error;
    }
    
    $stmt->close();
    $koneksi->close();

} else {
    // Jika halaman diakses langsung tanpa metode POST, kembalikan ke form booking
    header('Location: booking.php');
}
?>