<?php
// --- Konfigurasi Database --- //
$servername = "localhost"; // Nama server, biasanya "localhost"
$username = "root";      // Username database, defaultnya "root"
$password = "";          // Password database, defaultnya kosong
$dbname = "pendakian_gunung_merbabu"; // Nama database sesuai dengan file .sql Anda

// --- Membuat Koneksi --- //
$koneksi = new mysqli($servername, $username, $password, $dbname);

// --- Cek Koneksi --- //
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Opsional: Baris ini bisa dihapus jika tidak ada masalah koneksi.
// echo "Koneksi berhasil"; 
?>