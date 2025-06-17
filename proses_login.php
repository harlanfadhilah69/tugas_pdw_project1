<?php
// Memulai session di baris paling atas!
session_start();

require 'koneksi.php';

// Pastikan ini adalah request POST dari form login
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit('Akses ditolak.');
}

$username = $_POST['username'];
$password = $_POST['password'];

// 1. Ambil data user dari database, termasuk kolom 'role' dan 'alamat_email'
$sql = "SELECT id_pendaftaran, nama_lengkap, alamat_email, username, password, role FROM pendaftaran WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // User ditemukan, sekarang verifikasi password
    $user = $result->fetch_assoc();

    // 2. Gunakan password_verify() untuk membandingkan password dari form dengan hash di database
    if (password_verify($password, $user['password'])) {
        
        // Password cocok! Buat semua session yang dibutuhkan.
        $_SESSION['sudah_login'] = true;
        $_SESSION['user_id'] = $user['id_pendaftaran'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['alamat_email'];
        $_SESSION['username'] = $user['username']; // <-- Session username ditambahkan di sini
        
        // 3. Logika pengalihan berdasarkan role
        if ($user['role'] === 'admin') {
            // Jika rolenya admin, arahkan ke admin.php
            header('Location: admin.php');
        } else {
            // Jika rolenya user, arahkan ke index.php
            header('Location: index.php');
        }
        exit();
    }
}

// Jika username tidak ditemukan atau password salah, kembalikan ke login dengan pesan error
header('Location: login.php?status=gagal');
exit();
?>