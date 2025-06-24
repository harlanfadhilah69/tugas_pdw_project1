<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Taman Nasional Gunung Merbabu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Efek fade-in saat halaman dimuat */
        body {
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
        }
        body.fade-in {
            opacity: 1;
        }

        /* CSS untuk Panel Profil (tidak berubah) */
        #profile-panel {
            position: fixed; top: 0; left: -350px; width: 350px; height: 100%;
            background-color: white; box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            z-index: 1000; transition: left 0.4s ease-in-out; color: #333;
        }
        #profile-panel.open { left: 0; }
        #overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 999; }
        #overlay.show { display: block; }
    </style>
</head>
<body class="font-sans bg-gray-100">

    <header class="bg-green-700 text-white py-6 shadow-md relative z-20">
        <div class="container mx-auto px-6 flex justify-between items-center">
            
            <div class="flex items-center space-x-4">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <button id="profile-button" class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 transition">
                        <i class="fas fa-user text-xl"></i>
                    </button>
                <?php endif; ?>
                <a href="index.php"><h1 class="text-3xl font-bold">Taman Nasional Gunung Merbabu</h1></a>
            </div>
            
            <nav class="flex items-center space-x-4">
                <a href="index.php" class="bg-green-700 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md transition-colors">Beranda</a>
                <a href="tentang.php" class="bg-green-700 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md transition-colors">Tentang</a>
                <a href="contact.php" class="bg-green-700 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-md transition-colors">Kontak</a>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="booking.php" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition-colors">Booking</a>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
                        <a href="detail_booking.php" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md transition-colors">Detail Booking</a>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <a href="admin.php" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md transition-colors">Admin Dashboard</a>
                    <?php endif; ?>

                    <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-md transition-colors">Logout</a>

                <?php else: ?>
                    <a href="pendaftaran.php" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-4 py-2 rounded-md transition-colors">Pendaftaran</a>
                    <a href="login.php" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition-colors">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <?php if (isset($_SESSION['user_id'])): ?>
        <div id="overlay"></div>
        <div id="profile-panel" class="p-8 flex flex-col">
             <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl font-bold">Profil Anda</h2>
                <button id="close-profile-button" class="text-3xl text-gray-500 hover:text-gray-800">&times;</button>
            </div>
            <div class="text-center mb-8">
                <div class="w-24 h-24 bg-green-700 rounded-full mx-auto flex items-center justify-center mb-4 border-4 border-green-200">
                    <i class="fas fa-user text-4xl text-white"></i>
                </div>
                <h3 class="text-xl font-bold"><?php echo htmlspecialchars($_SESSION['nama_lengkap']); ?></h3>
                <p class="text-gray-500"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
            </div>
            <div class="space-y-4">
                <div class="bg-gray-100 p-4 rounded-lg">
                    <div class="text-sm font-semibold text-gray-500">Username</div>
                    <div class="font-bold text-lg"><?php echo htmlspecialchars($_SESSION['username']); ?></div>
                </div>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <div class="text-sm font-semibold text-gray-500">User ID</div>
                    <div class="font-bold text-lg"><?php echo htmlspecialchars($_SESSION['user_id']); ?></div>
                </div>
            </div>
            <div class="mt-auto">
                 <a href="logout.php" class="w-full text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-md transition-colors block">Logout</a>
            </div>
        </div>
    <?php endif; ?>

    <script>
        const profileButton = document.getElementById('profile-button');
        const profilePanel = document.getElementById('profile-panel');
        const closeProfileButton = document.getElementById('close-profile-button');
        const overlay = document.getElementById('overlay');

        if(profileButton && profilePanel && closeProfileButton && overlay) {
            const openPanel = () => { profilePanel.classList.add('open'); overlay.classList.add('show'); };
            const closePanel = () => { profilePanel.classList.remove('open'); overlay.classList.remove('show'); };
            profileButton.addEventListener('click', openPanel);
            closeProfileButton.addEventListener('click', closePanel);
            overlay.addEventListener('click', closePanel);
        }
    </script>
    
    <script>
        // Saat halaman selesai dimuat, tambahkan class 'fade-in' ke body
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('fade-in');
        });

        // Saat pengguna mengklik link navigasi, buat halaman jadi transparan sebelum pindah
        // Memilih semua link di dalam header
        const allLinks = document.querySelectorAll('header a'); 
        allLinks.forEach(link => {
            link.addEventListener('click', e => {
                const href = link.getAttribute('href');

                // Hanya jalankan jika link bukan anchor link (#) atau membuka tab baru
                if (href && href.indexOf('#') === -1 && link.target !== '_blank') {
                    e.preventDefault(); // Hentikan perpindahan halaman sejenak
                    document.body.style.opacity = '0'; // Buat halaman jadi transparan

                    // Tunggu animasi selesai, lalu pindah halaman
                    setTimeout(() => {
                        window.location.href = href;
                    }, 400); // 400ms cocok dengan durasi transisi di CSS
                }
            });
        });
    </script>
</body>
</html>