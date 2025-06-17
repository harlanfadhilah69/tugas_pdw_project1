<?php
session_start(); // Wajib untuk mengakses sesi

// Hapus semua variabel sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Alihkan ke halaman login dengan pesan sukses logout
header('Location: login.php?pesan=logout_sukses');
exit();
?>