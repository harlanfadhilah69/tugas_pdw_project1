<?php
require 'koneksi.php';

// Pastikan data dikirim dengan metode POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: pendaftaran.php');
    exit();
}

// 1. Ambil data dari form (variabel $alamat dihapus)
$nama_lengkap = $_POST['nama_lengkap'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// 2. Validasi Sederhana (pengecekan $alamat dihapus)
if (empty($nama_lengkap) || empty($email) || empty($username) || empty($password)) {
    die("Harap isi semua kolom.");
}

if (strlen($password) < 6) {
    die("Password minimal harus 6 karakter.");
}

// 3. Cek apakah username atau email sudah ada (Tidak ada perubahan di bagian ini)
// Cek Username
$sql_check_user = "SELECT id_pendaftaran FROM pendaftaran WHERE username = ?";
$stmt_check_user = $koneksi->prepare($sql_check_user);
$stmt_check_user->bind_param("s", $username);
$stmt_check_user->execute();
if ($stmt_check_user->get_result()->num_rows > 0) {
    header('Location: pendaftaran.php?status=gagal_username');
    exit();
}
$stmt_check_user->close();

// Cek Email
$sql_check_email = "SELECT id_pendaftaran FROM pendaftaran WHERE alamat_email = ?";
$stmt_check_email = $koneksi->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
if ($stmt_check_email->get_result()->num_rows > 0) {
    header('Location: pendaftaran.php?status=gagal_email');
    exit();
}
$stmt_check_email->close();

// 4. Enkripsi Password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// 5. Simpan data ke database
// --- TELAH DIPERBAIKI ---
// Kolom 'alamat' dihapus dari query INSERT
$sql = "INSERT INTO pendaftaran (nama_lengkap, alamat_email, username, password) VALUES (?, ?, ?, ?)";
// ------------------------
$stmt = $koneksi->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $koneksi->error);
}

// --- TELAH DIPERBAIKI ---
// Tipe data diubah menjadi "ssss" (4 string) dan variabel $alamat dihapus
$stmt->bind_param("ssss", $nama_lengkap, $email, $username, $hashed_password);
// ------------------------

// 6. Eksekusi dan Redirect
if ($stmt->execute()) {
    header('Location: login.php?status=daftar_sukses');
} else {
    header('Location: pendaftaran.php?status=gagal');
}

$stmt->close();
$koneksi->close();
?>