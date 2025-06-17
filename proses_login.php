<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit('Akses ditolak.');
}

$username = $_POST['username'];
$password = $_POST['password'];

// Ambil data user, termasuk kolom 'role' yang baru
$sql = "SELECT id_pendaftaran, nama_lengkap, password, role FROM pendaftaran WHERE username = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        // Password cocok, buat semua session
        $_SESSION['sudah_login'] = true;
        $_SESSION['user_id'] = $user['id_pendaftaran'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role']; // <-- SIMPAN ROLE KE SESSION

        // =======================================================
        // LOGIKA PENGALIHAN BERDASARKAN ROLE
        // =======================================================
        if ($user['role'] === 'admin') {
            // Jika rolenya admin, arahkan ke admin.php
            header('Location: admin.php');
        } else {
            // Jika rolenya user, arahkan ke index.php
            header('Location: index.php');
        }
        exit();
        // =======================================================
    }
}

// Jika username/password salah
header('Location: login.php?status=gagal');
exit();
?>