<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="font-playfair text-3xl">Seksi Pengendalian dan Penanganan Sengketa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- ✅ Import font Crimson Text dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- ✅ Tambahkan style langsung -->
    <style>
        body {
            font-family: 'Crimson Text', serif;
        }
    </style>

</head>
<body class="bg-[#DBD2AF]">
<header class="bg-[#DDDDCB] py-2 px-4 sm:px-6 flex justify-between items-center shadow-md h-16 sticky top-0 z-50">
  <div class="flex items-center space-x-2 sm:space-x-3">
    <img src="{{ asset('img/logofixbpn.png') }}" alt="LogoBPN" class="w-12 h-12 sm:w-20 sm:h-20 object-contain">
    <!-- Nama instansi: lebih kecil di mobile -->
    <h1 class="text-xl sm:text-2xl font-bold text-[#654321]">
    <!-- style="font-family: 'playfair', sans-serif;" -->
      <span class="hidden sm:inline">Seksi Pengendalian dan Penanganan Sengketa</span>
      <span class="inline sm:hidden">Seksi Pengendalian dan Penanganan Sengketa</span>
    </h1>
  </div>

  <!-- Tombol menu toggle hanya muncul di mobile -->
  <button id="menu-toggle" class="sm:hidden text-[#654321] text-2xl focus:outline-none">
    ☰
  </button>

  <!-- Menu navigasi -->
  <nav id="menu" class="hidden sm:flex flex-col sm:flex-row absolute sm:static top-full left-0 w-full sm:w-auto bg-[#DDDDCB] sm:bg-transparent shadow-md sm:shadow-none z-40 sm:z-auto">
  <ul class="flex flex-col sm:flex-row w-full sm:space-x-6 font-lexend font-bold text-base sm:text-lg px-4 sm:px-0 py-2 sm:py-0">
  <li><a href="#" class="block py-2 text-[#654321] hover:text-white hover:[text-shadow:0_0_4px_#800000] transition-all duration-300">BERANDA</a></li>
  <li><a href="#tentang" class="block py-2 text-[#654321] hover:text-white hover:[text-shadow:0_0_4px_#800000] transition-all duration-300">TENTANG</a></li>
  <li><a href="#layanan" class="block py-2 text-[#654321] hover:text-white hover:[text-shadow:0_0_4px_#800000] transition-all duration-300">LAYANAN</a></li>
  </ul>
  </nav>
</header>

<section class="relative h-screen flex items-center justify-center text-center text-white px-4">
    <img src="{{ asset('img/blur bg.jpg') }}" alt="Background" class="absolute w-full h-full object-cover opacity-70">
    <div class="relative z-10">
        <h2 class="text-2xl md:text-4xl font-bold mb-4">
            SELAMAT DATANG DI WEBSITE
        </h2>
        <h3 class="text-lg md:text-2xl font-semibold">
            SEKSI PENGENDALIAN DAN PENANGANAN SENGKETA<br>
            KANTOR PERTANAHAN KOTA MEDAN
        </h3>
        <button class="mt-6 px-6 py-2 bg-[#654321] text-white font-bold rounded-lg hover:bg-[#DDDCCB] hover:text-[#64481E]">
            <a href="/dashboard">LOGIN</a>
        </button>
    </div>
</section>

<section id="tentang" class="p-0 scroll-mt-20 ">
  <div class="relative w-full h-auto mb-6">
    <!-- SVG Gelombang sebagai Background Full -->
    <div class="absolute inset-x-0 -bottom-1 z-0">
      <img src="/img/wave.svg" class="w-full h-auto" alt="Gelombang">
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mx-auto max-w-4xl mt-10 transform transition duration-300 hover:scale-105 hover:shadow-xl border border-transparent hover:border-[#6B4D1F]">
      <p class="font-semibold text-justify leading-relaxed text-sm sm:text-base">
        Sesuai Pasal 4 Peraturan Presiden Republik Indonesia Nomor 47 tahun 2020 tentang Kementerian Agraria dan Tata Ruang,
        Kementerian Agraria dan Tata Ruang (ATR) mempunyai tugas menyelenggarakan urusan pemerintahan di bidang agraria/pertanahan dan tata ruang untuk membantu Presiden dalam menyelenggarakan pemerintahan negara.
        Sebagai pelaksana tugas tersebut, Kementerian ATR bertanggung jawab dalam perumusan dan pelaksanaan kebijakan nasional di bidang pertanahan, penataan ruang, serta pengelolaan administrasi pertanahan yang berkelanjutan dan berkeadilan.
        Kementerian ini juga berperan penting dalam menciptakan kepastian hukum hak atas tanah, mendukung pembangunan berkelanjutan, dan meningkatkan tata kelola ruang wilayah yang terintegrasi, efisien,
        serta berorientasi pada kepentingan masyarakat luas.
      </p>
    </div>
  </div>

  <div class="hidden sm:block w-full bg-[#DDDDCB] h-52 mt-[-30px]"></div>
  <div class="hidden sm:block w-full bg-[#DDDDCB] h-12 mt-[-30px]"></div>

  <div class="relative w-full">
  <div class="absolute -bottom-16 sm:-bottom-12 md:-bottom-8 inset-x-0">

      <img src="/img/wave (3).png" class="w-full h-auto" alt="Gelombang">
    </div>
  </div>

  <!-- SECTION: KONTEN UTAMA -->
<section class="bg-[#DBD2AF] py-16 relative z-10">
  <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Kartu SENGKETA -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col sm:flex-row items-center hover:scale-105 hover:shadow-xl transition">
      <div class="sm:w-2/3">
        <h3 class="text-lg font-bold text-[#6B4D1F] mb-2">Sengketa</h3>
        <p class="text-black font-medium text-sm sm:text-base">
        Menangani perselisihan kepemilikan atau batas tanah antara pihak-pihak terkait.Prosesnya melibatkan mediasi dan langkah hukum sesuai peraturan.
        </p>
      </div>
      <div class="sm:w-1/3 mt-4 sm:mt-0 flex justify-center">
        <img src="{{ asset('img/sengketa.jpg') }}" class="w-24 h-24 object-cover rounded-full border-2 border-black" alt="Sengketa">
      </div>
    </div>

    <!-- Kartu PENGADILAN NEGERI -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col sm:flex-row items-center hover:scale-105 hover:shadow-xl transition">
      <div class="sm:w-2/3">
        <h3 class="text-lg font-bold text-[#6B4D1F] mb-2">Perkara Pengadilan Negeri</h3>
        <p class="text-black font-medium text-sm sm:text-base">
        Mengurus perkara tanah yang diproses melalui Pengadilan Negeri.Biasanya berkaitan dengan gugatan kepemilikan atau hak atas tanah.
        </p>
      </div>
      <div class="sm:w-1/3 mt-4 sm:mt-0 flex justify-center">
        <img src="{{ asset('img/pengadilanegeri.jpeg') }}" class="w-24 h-24 object-cover rounded-full border-2 border-black" alt="Pengadilan Negeri">
      </div>
    </div>

    <!-- Kartu PTUN -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col sm:flex-row items-center hover:scale-105 hover:shadow-xl transition">
      <div class="sm:w-2/3">
        <h3 class="text-lg font-bold text-[#6B4D1F] mb-2">Perkara Pengadilan Tata Usaha Negara</h3>
        <p class="text-black font-medium text-sm sm:text-base">
          Menangani sengketa pertanahan yang berkaitan dengan keputusan tata usaha negara.
        </p>
      </div>
      <div class="sm:w-1/3 mt-4 sm:mt-0 flex justify-center">
        <img src="{{ asset('img/PTUN.png') }}" class="w-24 h-24 object-cover rounded-full border-2 border-black" alt="PTUN">
      </div>
    </div>

    <!-- Kartu PENGENDALIAN -->
    <div class="bg-white p-6 rounded-lg shadow-md flex flex-col sm:flex-row items-center hover:scale-105 hover:shadow-xl transition">
      <div class="sm:w-2/3">
        <h3 class="text-lg font-bold text-[#6B4D1F] mb-2">Pengendalian</h3>
        <p class="text-black font-medium text-sm sm:text-base">
        Mengawasi penggunaan dan pemanfaatan tanah agar sesuai dengan ketentuan hukum. Bertujuan mencegah penyalahgunaan atau penyimpangan hak tanah.
        </p>
      </div>
      <div class="sm:w-1/3 mt-4 sm:mt-0 flex justify-center">
        <img src="{{ asset('img/pengendalian.png') }}" class="w-24 h-24 object-cover rounded-full border-2 border-black" alt="Pengendalian">
      </div>
    </div>
  </div>
</section>

<div class="relative z-0 -mt-24">
  <img src="{{ asset('img/wave (1).svg') }}" class="w-full h-auto" alt="Wave to Footer">
</div>

<!-- SECTION: LAYANAN -->
<section class="bg-[#64481E] pt-6 pb-6 px-4 text-white relative z-10">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl mx-auto items-start">
    <div class="text-center space-y-4">
      <h3 class="text-xl md:text-xl font-semibold">Layanan apa saja yang kami sediakan?</h3>
      <img src="{{ asset('img/Layanan1.png') }}"
           class="w-full max-w-md mx-auto rounded-lg shadow-md border-4 border-white transition-transform transition-shadow duration-300 ease-in-out hover:scale-110 hover:shadow-xl"
           alt="Layanan Kiri">
    </div>
    <div class="text-center space-y-4">
      <h3 class="text-xl md:text-xl font-semibold">Menyimpan data seluruh sengketa pertanahan</h3>
      <img src="{{ asset('img/Layanan1.png') }}"
           class="w-full max-w-md mx-auto rounded-lg shadow-md border-4 border-white transition-transform transition-shadow duration-300 ease-in-out hover:scale-110 hover:shadow-xl"
           alt="Layanan Kanan">
    </div>
  </div>
</section>

<section class="bg-[#DDDDCB]"  id="layanan">

<div class="flex flex-col lg:flex-row justify-between items-start gap-6 p-6 max-w-screen-lg mx-auto">
  <!-- Left Section -->
  <div class="flex flex-col items-start gap-1">
    <div class="flex items-center gap-1">
      <img src="{{ asset('img/logofixbpn.png') }}" alt="Logo" class="w-30 h-16">
      <div class="-ml-1">
        <h2 class="font-bold text-lg">Seksi Pengendalian dan<br>Penanganan Sengketa</h2>
      </div>
    </div>
    <iframe  class="w-80 h-48 rounded-lg border-2 border-[#8B4513]" src="https://www.google.com/maps?q=Kantor+Pertanahan+Kota+Medan&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

<!-- Middle Section -->
<div class="flex flex-col gap-4">
  <h3 class="font-bold text-lg">Informasi Kontak</h3>

  <div class="flex items-center gap-2">
    <img src="/img/lokasi.png" class="w-6 h-6" alt="Lokasi">
    <span>Jl STM Siti Rejo II, Medan Amplas</span>
  </div>

  <a href="tel:081264247878" class="flex items-center gap-2">
    <img src="/img/call.png" class="w-6 h-6" alt="Call">
    <span>081264247878</span>
  </a>

  <a href="mailto:kot-medan@atrbpn.go.id" class="flex items-center gap-2">
  <img src="/img/gmail.png" class="w-6 h-6" alt="Message">
  <span>kot-medan@atrbpn.go.id</span>
  </a>

</div>

  <!-- Right Section -->
  <div class="flex flex-col gap-4">
    <h3 class="font-bold text-lg">Sosial Media</h3>
    <a href="https://www.facebook.com/share/18ga7wHUwV/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2">
    <img src="/img/facebook.png" class="w-6 h-6" alt="Facebook">
    <span>KantahKotaMedan</span>
    </a>

    <a href="https://www.instagram.com/kantahkotamedan?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2">
    <img src="/img/instagram.png" class="w-6 h-6" alt="Instagram">
    <span>kantahkotamedan</span>
    </a>

    <a href="https://x.com/KantahKotaMedan" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2">
    <img src="/img/twitter.png" class="w-6 h-6" alt="X">
    <span>kantahkotamedan</span>
    </a>


    <a href="https://www.tiktok.com/@kantahkotamedan?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2">
    <img src="/img/tik-tok.png" class="w-6 h-6" alt="TikTok">
    <span span>@kantahkotamedan</span>
    </a>

  </div>
</div>
</section>

<script>
  document.getElementById('menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('menu');
    menu.classList.toggle('hidden');
  });
</script>

    <!-- Tombol Scroll to Top -->
    <button id="scrollTopBtn" onclick="scrollToTop()" class="opacity-0 transition-opacity duration-300 fixed bottom-12 right-5 z-50 text-white p-3 rounded-lg shadow-lg hover:bg-red-700" style="background-color: #6B4D1F;">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <script>
        const scrollTopBtn = document.getElementById("scrollTopBtn");

        window.onscroll = function () {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollTopBtn.classList.remove("opacity-0");
                scrollTopBtn.classList.add("opacity-100");
            } else {
                scrollTopBtn.classList.add("opacity-0");
                scrollTopBtn.classList.remove("opacity-100");
            }
        };

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>

</body>
</html>
