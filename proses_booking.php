<?php
session_start();
require 'koneksi.php';

// Keamanan: Pastikan user sudah login dan request berasal dari form POST
if (!isset($_SESSION['user_id'])) {
    die("Akses ditolak. Anda harus login.");
}
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Metode tidak diizinkan.");
}

// Ambil semua data yang dibutuhkan
$userId = $_SESSION['user_id'];
$nama_lengkap = $_SESSION['nama_lengkap'];
$tanggal_pendakian = $_POST['tanggal'];
$jalur = $_POST['jalur'];

// Validasi sederhana
if (empty($tanggal_pendakian) || empty($jalur)) {
    die("Data tidak lengkap. Harap isi semua kolom.");
}

// =======================================================
// LOGIKA UPDATE ATAU INSERT (UPSERT)
// =======================================================

// 1. Cek apakah user sudah punya booking sebelumnya
$stmt_check = $koneksi->prepare("SELECT id_booking FROM booking WHERE id_user = ?");
$stmt_check->bind_param("i", $userId);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // 2a. JIKA SUDAH ADA: Lakukan UPDATE data yang lama
    $stmt_update = $koneksi->prepare("UPDATE booking SET tanggal_pendakian = ?, jalur_pendakian = ? WHERE id_user = ?");
    $stmt_update->bind_param("ssi", $tanggal_pendakian, $jalur, $userId);
    
    if ($stmt_update->execute()) {
        // Jika berhasil, alihkan ke halaman detail booking
        header('Location: detail_booking.php?status=update_sukses');
    } else {
        echo "Error saat memperbarui data: " . $stmt_update->error;
    }
    $stmt_update->close();

} else {
    // 2b. JIKA BELUM ADA: Lakukan INSERT data baru
    $stmt_insert = $koneksi->prepare("INSERT INTO booking (id_user, nama_lengkap, tanggal_pendakian, jalur_pendakian) VALUES (?, ?, ?, ?)");
    $stmt_insert->bind_param("isss", $userId, $nama_lengkap, $tanggal_pendakian, $jalur);
    
    if ($stmt_insert->execute()) {
        // Jika berhasil, alihkan ke halaman detail booking
        header('Location: detail_booking.php?status=buat_sukses');
    } else {
        echo "Error saat menyimpan data: " . $stmt_insert->error;
    }
    $stmt_insert->close();
}

$stmt_check->close();
$koneksi->close();
?>