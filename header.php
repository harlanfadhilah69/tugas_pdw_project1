<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Taman Nasional Gunung Merbabu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* CSS untuk carousel dan efek fade */
    .carousel-bg {
      position: absolute;
      inset: 0;
      z-index: 0;
      background-size: cover;
      background-position: center;
      transition: background-image 1s ease-in-out;
    }
    body.fade-in {
      animation: fadeIn 0.5s ease-in forwards;
    }
    body.fade-out {
      animation: fadeOut 0.5s ease-out forwards;
    }
    @keyframes fadeIn {
      from { opacity: 0 }
      to { opacity: 1 }
    }
    @keyframes fadeOut {
      from { opacity: 1 }
      to { opacity: 0 }
    }
  </style>
</head>
<body class="font-sans bg-white">

  <header class="bg-green-700 text-white py-6 shadow-md">
    <div class="container mx-auto px-6 flex justify-between items-center">
      <h1 class="text-3xl font-bold">Taman Nasional Gunung Merbabu</h1>
      <nav class="mt-4 space-x-4">
        <a href="index.php" class="hover:underline">Beranda</a>
        <a href="tentang.php" class="hover:underline">Tentang</a>
        
        <?php if (isset($_SESSION['user_id'])): ?>
          <a href="booking.php" class="hover:underline">Booking</a>
          <a href="logout.php" class="hover:underline">Logout</a>
        <?php else: ?>
          <a href="pendaftaran.php" class="hover:underline">Pendaftaran</a>
          <a href="login.php" class="hover:underline">Login</a>
        <?php endif; ?>

      </nav>
    </div>
  </header>