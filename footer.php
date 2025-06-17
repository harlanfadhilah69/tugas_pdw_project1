<footer class="bg-gray-100 text-center text-sm text-gray-600 py-4">
    &copy; 2025 Gunung Merbabu Explorer. All rights reserved.
  </footer>

  <script>
    // Pastikan elemen carousel ada sebelum menjalankan script-nya
    const carousel = document.getElementById('carousel');
    if (carousel) {
      const images = [
        'img/gambar1.jpg',
        'img/gambar2.jpg',
        'img/gambar3.jpg'
      ];
      let current = 0;

      function changeBackground() {
        carousel.style.backgroundImage = `url('${images[current]}')`;
        current = (current + 1) % images.length;
      }

      changeBackground(); 
      setInterval(changeBackground, 4000); 
    }
    
    // Script untuk efek transisi halaman
    document.body.classList.add('fade-in');
    document.querySelectorAll('a[href]').forEach(function(link) {
      // Pastikan link bukan link eksternal atau link ke halaman yang sama
      if (link.hostname === window.location.hostname && link.pathname !== window.location.pathname) {
        link.addEventListener('click', function(e) {
          e.preventDefault();
          document.body.classList.remove('fade-in');
          document.body.classList.add('fade-out');
          setTimeout(() => {
            window.location.href = link.href;
          }, 500);
        });
      }
    });
  </script>

</body>
</html>