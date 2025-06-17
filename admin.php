<?php
// ===============================================
// BAGIAN 1: LOGIKA PHP
// ===============================================
session_start();
require 'koneksi.php';

// Keamanan: Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Akses Ditolak. Anda bukan admin.");
}

// -- LOGIKA UNTUK MENGHAPUS DATA --
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus_booking') {
        $id = $_GET['id'];
        $stmt = $koneksi->prepare("DELETE FROM booking WHERE id_booking = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header('Location: admin.php?status=hapus_sukses');
        exit();
    }
    if ($_GET['aksi'] == 'hapus_user') {
        $id = $_GET['id'];
        // Hapus booking terkait user terlebih dahulu
        $stmt_booking = $koneksi->prepare("DELETE FROM booking WHERE id_user = ?");
        $stmt_booking->bind_param("i", $id);
        $stmt_booking->execute();
        
        // Hapus user
        $stmt_user = $koneksi->prepare("DELETE FROM pendaftaran WHERE id_pendaftaran = ?");
        $stmt_user->bind_param("i", $id);
        $stmt_user->execute();
        header('Location: admin.php?status=hapus_sukses');
        exit();
    }
}

// -- LOGIKA UNTUK MENANGANI UPDATE DATA (DARI FORM EDIT) --
if (isset($_POST['update_user'])) {
    $id = $_POST['id_pendaftaran'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $email = $_POST['alamat_email'];
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt = $koneksi->prepare("UPDATE pendaftaran SET nama_lengkap=?, alamat_email=?, username=?, password=?, role=? WHERE id_pendaftaran=?");
        $stmt->bind_param("sssssi", $nama_lengkap, $email, $username, $password_hash, $role, $id);
    } else {
        $stmt = $koneksi->prepare("UPDATE pendaftaran SET nama_lengkap=?, alamat_email=?, username=?, role=? WHERE id_pendaftaran=?");
        $stmt->bind_param("ssssi", $nama_lengkap, $email, $username, $role, $id);
    }
    $stmt->execute();
    header('Location: admin.php?status=edit_sukses');
    exit();
}

if (isset($_POST['update_booking'])) {
    $id = $_POST['id_booking'];
    $tanggal = $_POST['tanggal_pendakian'];
    $jalur = $_POST['jalur_pendakian'];
    
    $stmt = $koneksi->prepare("UPDATE booking SET tanggal_pendakian=?, jalur_pendakian=? WHERE id_booking=?");
    $stmt->bind_param("ssi", $tanggal, $jalur, $id);
    $stmt->execute();
    header('Location: admin.php?status=edit_sukses');
    exit();
}

// -- LOGIKA UNTUK MENGAMBIL DATA YANG AKAN DIEDIT --
$user_to_edit = null;
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit_user') {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("SELECT * FROM pendaftaran WHERE id_pendaftaran = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user_to_edit = $stmt->get_result()->fetch_assoc();
}

$booking_to_edit = null;
if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit_booking') {
    $id = $_GET['id'];
    $stmt = $koneksi->prepare("SELECT * FROM booking WHERE id_booking = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $booking_to_edit = $stmt->get_result()->fetch_assoc();
}

// -- Mengambil semua data untuk ditampilkan di tabel --
$result_users = $koneksi->query("SELECT * FROM pendaftaran ORDER BY id_pendaftaran DESC");
$sql_bookings = "SELECT b.*, p.username FROM booking b LEFT JOIN pendaftaran p ON b.id_user = p.id_pendaftaran ORDER BY b.id_booking DESC";
$result_bookings = $koneksi->query($sql_bookings);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Gunung Merbabu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<?php require 'header.php'; ?>

<main class="container mx-auto px-6 py-8">
    <h1 class="text-4xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

    <?php if ($user_to_edit): ?>
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8" id="form-edit-user">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Edit Pengguna: <?php echo htmlspecialchars($user_to_edit['nama_lengkap']); ?></h2>
        <form action="admin.php" method="POST">
            <input type="hidden" name="id_pendaftaran" value="<?php echo $user_to_edit['id_pendaftaran']; ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="nama_lengkap" value="<?php echo htmlspecialchars($user_to_edit['nama_lengkap']); ?>" class="p-2 border rounded" required>
                <input type="email" name="alamat_email" value="<?php echo htmlspecialchars($user_to_edit['alamat_email']); ?>" class="p-2 border rounded" required>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user_to_edit['username']); ?>" class="p-2 border rounded" required>
                <input type="password" name="password" placeholder="Isi untuk ganti password" class="p-2 border rounded">
                <select name="role" class="p-2 border rounded">
                    <option value="user" <?php echo $user_to_edit['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                    <option value="admin" <?php echo $user_to_edit['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>
            <div class="mt-4">
                <button type="submit" name="update_user" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Simpan Perubahan</button>
                <a href="admin.php" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500 ml-2">Batal</a>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <?php if ($booking_to_edit): ?>
    <div class="bg-white p-6 rounded-lg shadow-lg mb-8" id="form-edit-booking">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Edit Booking ID: <?php echo $booking_to_edit['id_booking']; ?></h2>
        <form action="admin.php" method="POST">
            <input type="hidden" name="id_booking" value="<?php echo $booking_to_edit['id_booking']; ?>">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="date" name="tanggal_pendakian" value="<?php echo htmlspecialchars($booking_to_edit['tanggal_pendakian']); ?>" class="p-2 border rounded" required>
                
                <select name="jalur_pendakian" class="p-2 border rounded" required>
                    <option value="">-- Pilih Jalur --</option>
                    <?php
                    $jalur_options = ['Selo', 'Wekas', 'Suwanting', 'Thekelan'];
                    foreach ($jalur_options as $option) {
                        // Cek apakah opsi ini adalah jalur yang sedang diedit, jika ya, buat terpilih (selected)
                        $selected = ($booking_to_edit['jalur_pendakian'] == $option) ? 'selected' : '';
                        echo "<option value=\"$option\" $selected>" . htmlspecialchars($option) . "</option>";
                    }
                    ?>
                </select>
                </div>
            <div class="mt-4">
                <button type="submit" name="update_booking" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Simpan Perubahan</button>
                <a href="admin.php" class="bg-gray-400 text-white py-2 px-4 rounded hover:bg-gray-500 ml-2">Batal</a>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Manajemen Booking</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">No</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Username</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Lengkap</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Tanggal</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Jalur</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php 
                    $nomor_booking = 1;
                    while ($booking = $result_bookings->fetch_assoc()): 
                    ?>
                    <tr class="border-b">
                        <td class="py-3 px-4"><?php echo $nomor_booking++; ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($booking['username'] ?: 'N/A'); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($booking['nama_lengkap']); ?></td>
                        <td class="py-3 px-4"><?php echo date('d M Y', strtotime($booking['tanggal_pendakian'])); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($booking['jalur_pendakian']); ?></td>
                        <td class="py-3 px-4 text-center">
                            <a href="admin.php?aksi=edit_booking&id=<?php echo $booking['id_booking']; ?>" class="text-blue-500 hover:text-blue-700 font-semibold">Edit</a>
                            <a href="admin.php?aksi=hapus_booking&id=<?php echo $booking['id_booking']; ?>" onclick="return confirm('Anda yakin ingin menghapus booking ini?');" class="text-red-500 hover:text-red-700 font-semibold ml-4">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Manajemen Pengguna</h2>
         <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">No</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Lengkap</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Email</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Username</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Role</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    <?php 
                    $nomor_user = 1;
                    while ($user = $result_users->fetch_assoc()): 
                    ?>
                    <tr class="border-b">
                        <td class="py-3 px-4"><?php echo $nomor_user++; ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($user['nama_lengkap']); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($user['alamat_email']); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 font-semibold leading-tight <?php echo $user['role'] == 'admin' ? 'text-green-700 bg-green-100' : 'text-gray-700 bg-gray-100'; ?> rounded-full">
                                <?php echo htmlspecialchars($user['role']); ?>
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="admin.php?aksi=edit_user&id=<?php echo $user['id_pendaftaran']; ?>" class="text-blue-500 hover:text-blue-700 font-semibold">Edit</a>
                            <a href="admin.php?aksi=hapus_user&id=<?php echo $user['id_pendaftaran']; ?>" onclick="return confirm('PERINGATAN: Menghapus user juga akan menghapus semua data booking miliknya. Lanjutkan?');" class="text-red-500 hover:text-red-700 font-semibold ml-4">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require 'footer.php'; ?>

</body>
</html>