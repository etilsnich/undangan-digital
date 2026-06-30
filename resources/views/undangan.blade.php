<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Digital - Anggita & Roy</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Core Particles.js via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-wedding { font-family: 'Great Vibes', cursive; }
        .bg-watercolor {
            background: radial-gradient(circle at 50% 30%, rgb(240, 247, 255) 0%, rgb(224, 236, 254) 40%, rgb(199, 223, 254) 100%);
            background-attachment: fixed;
        }
        .bg-card-watercolor {
            background: radial-gradient(circle at 50% 50%, rgba(224, 242, 254, 0.6) 0%, rgba(255, 255, 255, 0.95) 80%);
        }
        html { scroll-behavior: smooth; }
        
        /* Animasi piringan hitam musik berputar */
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        .animate-spin-slow { animation: spin 6s linear infinite; }

        /* Efek muncul smooth pas di-scroll */
        .efek-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1.2s ease, transform 1.2s ease;
        }
        .efek-scroll.muncul-aktif {
            opacity: 1;
            transform: translateY(0);
        }

        /* Background Watercolor Custom */
        .bg-cover-watercolor {
            background: linear-gradient(135deg, #e0f2fe 0%, #ffffff 50%, #bae6fd 100%);
            /* Kalau punya gambar background awan/watercolor, bisa aktifkan baris di bawah: */
            /* background-image: url('{{ asset("images/bg-watercolor.jpg") }}'); background-size: cover; */
        }

        /* Efek Bingkai FOTO Organik (Blob / Sapuan Kuas) */
        .mask-blob {
            border-radius: 73% 27% 33% 67% / 46% 62% 38% 54%;
            animation: bentukOrganik 6s ease-in-out infinite alternate;
        }

        @keyframes bentukOrganik {
            0% { border-radius: 73% 27% 33% 67% / 46% 62% 38% 54%; }
            50% { border-radius: 41% 59% 46% 54% / 41% 47% 53% 59%; }
            100% { border-radius: 54% 46% 55% 45% / 51% 44% 56% 49%; }
        }
    </style>
</head>
<body class="bg-stone-100 antialiased flex justify-center items-center min-h-screen relative overflow-x-hidden">

    <!-- ELEMENT AUDIO -->
    <audio id="wedding-audio" loop>
        <source src="{{ asset('audio/itsyou.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- TOMBOL MUSIK FLOATING -->
    <button id="music-control" onclick="toggleMusik()" class="hidden fixed bottom-6 right-6 z-40 bg-white/80 border border-slate-300 text-slate-700 p-3 rounded-full shadow-lg hover:bg-white transition duration-300 focus:outline-none">
        <svg id="music-icon" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
        </svg>
    </button>

    <!-- NOTIFIKASI TOAST POPUP LOKASI/REKENING/SUKSES SALIN -->
    <div id="toast-notif" class="fixed top-12 left-1/2 -translate-x-1/2 z-50 bg-emerald-600 text-white text-xs font-medium py-2.5 px-5 rounded-xl shadow-xl transition-all duration-300 opacity-0 pointer-events-none transform -translate-y-2">
        ✅ Berhasil Disalin!
    </div>

    <!-- ======================================================== -->
    <!-- 1. HALAMAN COVER / OPENING (DENGAN PARTIKEL GEMBUL)     -->
    <!-- ======================================================== -->
    <div id="cover-page" class="fixed inset-0 z-50 max-w-md mx-auto bg-cover-watercolor flex flex-col justify-between items-center py-12 px-6 shadow-2xl transition-all duration-1000 ease-in-out border-x border-blue-200 overflow-hidden">
        
        <div id="particles-js" class="absolute inset-0 z-10 pointer-events-none"></div>

        <!-- ORNAMEN BUNGA KANAN & KIRI ATAS -->
        <!-- Ukuran dikecilin (w-[220px]) dan didorong mentok ke pojok atas -->
        <img src="{{ asset('images/bunga-atas.png') }}" class="absolute top-[-70px] left-[-70px] w-[220px] z-20 pointer-events-none opacity-95" alt="Bunga Kiri">
        <img src="{{ asset('images/bunga-atas.png') }}" class="absolute top-[-70px] right-[-70px] w-[220px] z-20 pointer-events-none opacity-95 scale-x-[-1]" alt="Bunga Kanan">

        <!-- ORNAMEN TENGAH (Di pinggir KIRI & KANAN layar) -->
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[-5%] left-[-140px] w-[280px] z-10 pointer-events-none opacity-60 rotate-45 mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[10%] left-[-170px] w-[320px] z-10 pointer-events-none opacity-70 -rotate-12 mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[25%] left-[-150px] w-[280px] z-10 pointer-events-none opacity-60 rotate-90 mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[40%] left-[-180px] w-[340px] z-10 pointer-events-none opacity-50 -rotate-45 mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[55%] left-[-150px] w-[280px] z-10 pointer-events-none opacity-70 rotate-12 mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[70%] left-[-170px] w-[320px] z-10 pointer-events-none opacity-60 -rotate-90 mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[85%] left-[-140px] w-[280px] z-10 pointer-events-none opacity-80 rotate-45 mix-blend-multiply" alt="Ornamen">

        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[-5%] right-[-140px] w-[280px] z-10 pointer-events-none opacity-60 -rotate-45 scale-x-[-1] mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[10%] right-[-170px] w-[320px] z-10 pointer-events-none opacity-70 rotate-12 scale-x-[-1] mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[25%] right-[-150px] w-[280px] z-10 pointer-events-none opacity-60 -rotate-90 scale-x-[-1] mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[40%] right-[-180px] w-[340px] z-10 pointer-events-none opacity-50 rotate-45 scale-x-[-1] mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[55%] right-[-150px] w-[280px] z-10 pointer-events-none opacity-70 -rotate-12 scale-x-[-1] mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[70%] right-[-170px] w-[320px] z-10 pointer-events-none opacity-60 rotate-90 scale-x-[-1] mix-blend-multiply" alt="Ornamen">
        <img src="{{ asset('images/ornamen-tengah.png') }}" class="absolute top-[85%] right-[-140px] w-[280px] z-10 pointer-events-none opacity-80 -rotate-45 scale-x-[-1] mix-blend-multiply" alt="Ornamen">

        <!-- ORNAMEN DAUN EMAS BAWAH -->
        <img src="{{ asset('images/daun-biru.png') }}" class="absolute -bottom-20 -left-16 w-60 z-20 pointer-events-none opacity-80" alt="Daun Kiri">
        <img src="{{ asset('images/daun-biru.png') }}" class="absolute -bottom-20 -right-16 w-60 z-20 pointer-events-none opacity-80 scale-x-[-1]" alt="Daun Kanan">

        <!-- KONTEN ATAS -->
        <div class="z-30 text-center mt-12">
            <p class="text-[11px] uppercase tracking-[0.3em] text-[#4a6382] font-bold mb-4">The Wedding Of</p>
        </div>

        <!-- FOTO TENGAH (Bulat Bersih) -->
        <div class="relative my-4 z-30 flex justify-center items-center h-80 w-full">
            <div class="relative w-56 h-56 rounded-full overflow-hidden shadow-xl p-1.5 bg-white/80 z-10 border border-white">
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=500&q=80" alt="Mempelai" class="w-full h-full object-cover rounded-full">
            </div>
        </div>

        <div class="text-center z-30 mt-2">
            <h1 class="font-wedding text-[4.5rem] leading-none text-[#4a6382] font-medium drop-shadow-sm">Anggita & Roy</h1>
        </div>

        <!-- KONTEN NAMA TAMU -->
        <div class="text-center space-y-3 max-w-xs z-30 mb-8">
            <p class="text-xs text-slate-700 font-medium">Kepada Yth. Bapak/Ibu/Saudara/i</p>
            <h2 class="text-2xl font-bold text-[#4a6382] tracking-wide">{{ request('to', 'Nama Tamu') }}</h2>
            <p class="text-[10px] text-slate-600 leading-relaxed italic max-w-[250px] mx-auto">*Mohon maaf apabila ada kesalahan pada penulisan nama dan gelar</p>
        </div>

        <!-- TOMBOL BUKA UNDANGAN -->
        <div class="w-full px-8 z-30 mb-6">
            <!-- Warna tombol dan border-radius disesuaikan dengan contoh gambar -->
            <button onclick="bukaUndangan()" class="w-full bg-[#4a6382] hover:bg-[#384e68] text-white font-semibold py-3 px-4 rounded-full transition duration-300 text-sm shadow-lg flex justify-center items-center gap-2 tracking-wide">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l8-5.333a2 2 0 012.22 0l8 5.333A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" /></svg>
                Buka Undangan
            </button>
        </div>
    </div>


    <!-- ======================================================== -->
    <!-- 2. ISI KONTEN PANJANG UNDANGAN                           -->
    <!-- ======================================================== -->
    <div id="main-content" class="hidden max-w-md w-full bg-watercolor min-h-screen shadow-2xl border-x border-blue-200 flex flex-col overflow-y-auto">
        
        <!-- SECTION 2.1: HERO SCROLL PERTAMA -->
        <div class="relative w-full flex flex-col items-center pb-8">
            <div class="relative w-full h-[500px] overflow-hidden">
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80" alt="Prewedding Hero" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-blue-100 via-transparent to-transparent"></div>
            </div>

            <div class="text-center px-4 -mt-12 z-20 space-y-3 w-full">
                <p class="text-xs uppercase tracking-[0.2em] text-slate-600 font-semibold">The Wedding Of</p>
                <h2 class="font-wedding text-5xl text-slate-700 tracking-wide">Anggita & Roy</h2>
                <p class="text-xs text-slate-600 font-medium tracking-wide border-b border-slate-300 max-w-[200px] mx-auto pb-2">
                    Sabtu, 30 Desember 2026
                </p>

                <!-- BOX COUNTDOWN TIMER -->
                <div class="grid grid-cols-4 gap-2 max-w-xs mx-auto pt-2">
                    <div class="bg-slate-600/80 text-white rounded-xl py-2 px-1 text-center shadow-md">
                        <span id="days" class="block text-lg font-bold tracking-wider">00</span>
                        <span class="text-[10px] uppercase font-medium text-slate-200">Hari</span>
                    </div>
                    <div class="bg-slate-600/80 text-white rounded-xl py-2 px-1 text-center shadow-md">
                        <span id="hours" class="block text-lg font-bold tracking-wider">00</span>
                        <span class="text-[10px] uppercase font-medium text-slate-200">Jam</span>
                    </div>
                    <div class="bg-slate-600/80 text-white rounded-xl py-2 px-1 text-center shadow-md">
                        <span id="minutes" class="block text-lg font-bold tracking-wider">00</span>
                        <span class="text-[10px] uppercase font-medium text-slate-200">Menit</span>
                    </div>
                    <div class="bg-slate-600/80 text-white rounded-xl py-2 px-1 text-center shadow-md">
                        <span id="seconds" class="block text-lg font-bold tracking-wider">00</span>
                        <span class="text-[10px] uppercase font-medium text-slate-200">Detik</span>
                    </div>
                </div>

                <div class="pt-3">
                    <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=The+Wedding+of+Anggita+%26+Roy&dates=20261230T080000Z/20261230T170000Z" target="_blank" class="inline-flex items-center gap-1.5 bg-slate-600 hover:bg-slate-700 text-white text-xs font-semibold py-2 px-4 rounded-xl shadow-md transition duration-200">
                         Berkunjung Ke Kalender
                    </a>
                </div>
            </div>
        </div>

        <!-- SECTION 2.2: SCROLL KEDUA - PROFIL MEMPELAI -->
        <div class="px-6 py-12 text-center space-y-8 efek-scroll flex flex-col items-center">
            <div class="space-y-2 mb-4">
                <h3 class="font-wedding text-4xl text-slate-700">Assalamualaikum Wr. Wb.</h3>
                <p class="text-xs text-slate-600 leading-relaxed max-w-xs mx-auto italic">
                    Dengan memohon Rahmat dan Ridho Allah SWT, Kami bermaksud mengundang Bapak/Ibu/Saudara/i untuk hadir dalam pernikahan kami
                </p>
            </div>

            <!-- Mempelai Wanita (Anggita) -->
            <div class="space-y-3 flex flex-col items-center w-full">
                <div class="w-52 h-72 rounded-full overflow-hidden border-4 border-white shadow-xl bg-gradient-to-b from-sky-100 to-blue-200">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=400&q=80" alt="Anggita" class="w-full h-full object-cover">
                </div>
                <h3 class="font-wedding text-4xl text-slate-700 font-medium">Anggita Rizki Syahwalia</h3>
                <p class="text-xs text-slate-600 font-semibold tracking-wide">
                    Putri Bungsu dari Bapak H. Ali Fauzi<br>dan Ibu Hj. Muafiatin Nufus (Almh)
                </p>
                <div class="flex gap-3 pt-1">
                    <a href="#" class="bg-slate-600 hover:bg-slate-700 text-white p-2 rounded-full shadow transition"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                    <a href="#" class="bg-slate-600 hover:bg-slate-700 text-white p-2 rounded-full shadow transition"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg></a>
                </div>
            </div>
            
            <div class="font-wedding text-5xl text-slate-400 select-none py-2">&</div>

            <!-- Mempelai Pria (Roy) -->
            <div class="space-y-3 flex flex-col items-center w-full">
                <div class="w-52 h-72 rounded-full overflow-hidden border-4 border-white shadow-xl bg-gradient-to-b from-sky-100 to-blue-200">
                    <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=400&q=80" alt="Roy" class="w-full h-full object-cover">
                </div>
                <h3 class="font-wedding text-4xl text-slate-700 font-medium">Roy Haanudin, S.M</h3>
                <p class="text-xs text-slate-600 font-semibold tracking-wide">
                    Putra Ketiga dari Bapak Ust. Abdurohman<br>dan Ibu Rohilah
                </p>
                <div class="flex gap-3 pt-1">
                    <a href="#" class="bg-slate-600 hover:bg-slate-700 text-white p-2 rounded-full shadow transition"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg></a>
                    <a href="#" class="bg-slate-600 hover:bg-slate-700 text-white p-2 rounded-full shadow transition"><svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg></a>
                </div>
            </div>
        </div>

        <!-- SECTION 2.3: ACARA -->
        <div class="bg-slate-500/80 w-full py-12 px-4 space-y-8 flex flex-col items-center border-y border-slate-400/30 efek-scroll">
            <!-- CARD 1: AKAD NIKAH -->
            <div class="relative w-full max-w-sm bg-card-watercolor border border-white/60 shadow-xl rounded-3xl p-8 text-center space-y-4 overflow-hidden">
                <h4 class="font-wedding text-4xl text-slate-700 tracking-wide">Akad Nikah</h4>
                <div class="space-y-1">
                    <p class="text-sm font-bold uppercase tracking-widest text-slate-700">Sabtu, 30 Desember 2026</p>
                    <p class="text-xs text-slate-600 font-medium">Pukul 08.00 WIB s.d Selesai</p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Bertempat di</p>
                    <p class="text-sm font-bold text-slate-700 leading-relaxed">Gedung Al Khairiyah<br>Citangkil, Cilegon</p>
                </div>
                <div class="pt-2">
                    <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-2 bg-slate-600 hover:bg-slate-700 text-white text-xs font-semibold py-2.5 px-5 rounded-xl shadow-md transition duration-300">
                        📍 Google Maps Lokasi
                    </a>
                </div>
                <!-- ORNAMEN DAUN EMAS -->
                <div class="absolute bottom-0 left-0 w-16 h-16 opacity-80 pointer-events-none">
                    <svg viewBox="0 0 100 100" class="w-full h-full fill-none stroke-amber-500 stroke-[1.5]"><path d="M10,90 Q30,60 50,50 M50,50 Q70,45 85,35 M50,50 Q45,70 35,85" stroke-linecap="round"/><path d="M25,72 Q20,60 30,55 M38,56 Q30,42 45,40 M62,47 Q60,35 72,38" stroke-linecap="round"/></svg>
                </div>
                <div class="absolute bottom-0 right-0 w-16 h-16 opacity-80 pointer-events-none scale-x-[-1]">
                    <svg viewBox="0 0 100 100" class="w-full h-full fill-none stroke-amber-500 stroke-[1.5]"><path d="M10,90 Q30,60 50,50 M50,50 Q70,45 85,35 M50,50 Q45,70 35,85" stroke-linecap="round"/><path d="M25,72 Q20,60 30,55 M38,56 Q30,42 45,40 M62,47 Q60,35 72,38" stroke-linecap="round"/></svg>
                </div>
            </div>

            <!-- CARD 2: RESEPSI -->
            <div class="relative w-full max-w-sm bg-card-watercolor border border-white/60 shadow-xl rounded-3xl p-8 text-center space-y-4 overflow-hidden">
                <h4 class="font-wedding text-4xl text-slate-700 tracking-wide">Resepsi</h4>
                <div class="space-y-1">
                    <p class="text-sm font-bold uppercase tracking-widest text-slate-700">Sabtu, 30 Desember 2026</p>
                    <p class="text-xs text-slate-600 font-medium">Pukul 12.00 s.d 17.00 WIB</p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Bertempat di</p>
                    <p class="text-sm font-bold text-slate-700 leading-relaxed">Gedung Al Khairiyah<br>Citangkil, Cilegon</p>
                </div>
                <div class="pt-2">
                    <a href="https://maps.google.com" target="_blank" class="inline-flex items-center gap-2 bg-slate-600 hover:bg-slate-700 text-white text-xs font-semibold py-2.5 px-5 rounded-xl shadow-md transition duration-300">
                        📍 Google Maps Lokasi
                    </a>
                </div>
                <!-- ORNAMEN DAUN EMAS -->
                <div class="absolute bottom-0 left-0 w-16 h-16 opacity-80 pointer-events-none">
                    <svg viewBox="0 0 100 100" class="w-full h-full fill-none stroke-amber-500 stroke-[1.5]"><path d="M10,90 Q30,60 50,50 M50,50 Q70,45 85,35 M50,50 Q45,70 35,85" stroke-linecap="round"/><path d="M25,72 Q20,60 30,55 M38,56 Q30,42 45,40 M62,47 Q60,35 72,38" stroke-linecap="round"/></svg>
                </div>
                <div class="absolute bottom-0 right-0 w-16 h-16 opacity-80 pointer-events-none scale-x-[-1]">
                    <svg viewBox="0 0 100 100" class="w-full h-full fill-none stroke-amber-500 stroke-[1.5]"><path d="M10,90 Q30,60 50,50 M50,50 Q70,45 85,35 M50,50 Q45,70 35,85" stroke-linecap="round"/><path d="M25,72 Q20,60 30,55 M38,56 Q30,42 45,40 M62,47 Q60,35 72,38" stroke-linecap="round"/></svg>
                </div>
            </div>

            <!-- EMBED MAPS -->
            <div class="w-full max-w-sm h-48 rounded-2xl overflow-hidden shadow-lg border-2 border-white">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.142828350849!2d106.0163456!3d-5.9737286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2a3a7bcf1fb76595%3A0x67c293557e4e1a06!2sCitangkil%2C%20Cilegon%20City%2C%20Banten!5e0!3m2!1sid!2sid!4v1711789666000!5m2!1sid!2sid" class="w-full h-full border-0" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <!-- SECTION 2.4: TIMELINE OUR STORY -->
        <div class="w-full py-12 px-4 flex flex-col items-center space-y-6">
            <h4 class="font-wedding text-5xl text-slate-700 tracking-wide text-center">Our Story</h4>
            <div class="relative border-l-2 border-slate-300 w-full max-w-sm pl-6 space-y-8 py-2">
                <div class="relative bg-white/70 border border-slate-300 rounded-2xl p-4 shadow-md space-y-3 efek-scroll">
                    <span class="absolute -left-[35px] top-4 bg-slate-600 text-white w-6 h-6 rounded-full flex justify-center items-center text-xs shadow-sm">❤️</span>
                    <div class="w-full h-48 overflow-hidden rounded-xl">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
                    </div>
                    <h5 class="text-sm font-bold text-slate-700">15 April 2022</h5>
                    <p class="text-[11px] text-slate-600 leading-relaxed">Roy mulai chat-chat di sosial media tapi gak ada respon dari aku. Di tanggal 22 April mulai chat lagi tapi gak ada respon juga. Akhirnya di tanggal 12 Juni mulai kubalas chat dari Roy.</p>
                </div>
                <div class="relative bg-white/70 border border-slate-300 rounded-2xl p-4 shadow-md space-y-3 efek-scroll">
                    <span class="absolute -left-[35px] top-4 bg-slate-600 text-white w-6 h-6 rounded-full flex justify-center items-center text-xs shadow-sm">❤️</span>
                    <div class="w-full h-48 overflow-hidden rounded-xl">
                        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover">
                    </div>
                    <h5 class="text-sm font-bold text-slate-700">19 Juni 2022</h5>
                    <p class="text-[11px] text-slate-600 leading-relaxed">Roy ngajakin untuk first date, meskipun kita sama-sama tinggal di satu kampung tapi gak saling kenal satu sama lain haha lucu deh. Akhirnya kita mulai first date di salah satu cafe di Cilegon.</p>
                </div>
            </div>
        </div>

        <!-- SECTION 2.5: REKAYASA GRID TEGAK MURNI + BG COLOR BBC9E3 -->
        <div class="w-full py-12 px-4 space-y-6 flex flex-col items-center">
            <h4 class="font-wedding text-5xl text-slate-700 tracking-wide text-center">Our Gallery</h4>
            <div class="grid grid-cols-6 gap-[7px] w-full max-w-sm efek-scroll bg-[#bbc9e3] p-[7px]">
                <!-- BARIS 1 -->
                <div class="col-span-2 h-[220px] overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=300&h=450&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                </div>
                <div class="col-span-2 h-[220px] overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=300&h=450&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                </div>
                <div class="col-span-2 h-[220px] overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=300&h=450&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                </div>
                <!-- BARIS 2 -->
                <div class="col-span-3 h-[140px] overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?auto=format&fit=crop&w=400&h=260&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                </div>
                <div class="col-span-3 h-[140px] overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=400&h=260&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                </div>
                <!-- BARIS 3 -->
                <div class="col-span-2 grid grid-rows-2 gap-[7px]">
                    <div class="h-[96px] overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?auto=format&fit=crop&w=300&h=200&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                    </div>
                    <div class="h-[96px] overflow-hidden bg-slate-100">
                        <img src="https://images.unsplash.com/photo-1532712938310-34cb3982ef74?auto=format&fit=crop&w=300&h=200&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                    </div>
                </div>
                <div class="col-span-4 h-[200px] overflow-hidden bg-slate-100">
                    <img src="https://images.unsplash.com/photo-1515934751635-c81c6bc9a2d8?auto=format&fit=crop&w=500&h=350&q=80" class="w-full h-full object-cover transition-transform duration-500 ease-out hover:scale-110">
                </div>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- SECTION 2.6: WEDDING GIFT, UCAPAN, & RSVP (KOMPLIT)      -->
        <!-- ======================================================== -->
        <div class="w-full py-12 px-4 flex flex-col items-center space-y-6 border-b border-slate-400/30 efek-scroll" style="background-color: #5f839b;">
            
            <!-- SUB-SECTION 2.6.1: KADO CASHLESS (ATAS) -->
            <div class="w-full flex flex-col items-center space-y-6 efek-scroll">
                <div class="text-center text-white space-y-2 max-w-sm px-2">
                    <div class="flex justify-center">
                        <svg class="w-12 h-12 text-white" viewBox="0 0 512 512" fill="currentColor"><path d="M32 448c0 17.7 14.3 32 32 32h160V320H32v128zm256 32h160c17.7 0 32-14.3 32-32V320H288v160zm192-320h-42.1c6.2-12.1 10.1-25.5 10.1-40 0-48.5-39.5-88-88-88-41.6 0-68.5 21.3-103 68.3-34.5-47-61.4-68.3-103-68.3-48.5 0-88 39.5-88 88 0 14.5 3.8 27.9 10.1 40H32c-17.7 0-32 14.3-32 32v80c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16v-80c0-17.7-14.3-32-32-32zm-326.1 0c-22.1 0-40-17.9-40-40s17.9-40 40-40c19.9 0 34.6 3.3 86.1 80h-86.1zm206.1 0h-86.1c51.4-76.5 65.7-80 86.1-80 22.1 0 40 17.9 40 40s-17.9 40-40 40z"/></svg>
                    </div>
                    <h4 class="font-wedding text-5xl text-white tracking-wide">Wedding Gift</h4>
                    <p class="text-[11px] leading-relaxed opacity-90 italic">Doa Restu Anda merupakan karunia yang sangat berarti bagi kami. Dan jika memberi adalah ungkapan tanda kasih, Anda dapat memberi kado secara cashless.</p>
                </div>

                <div class="grid grid-cols-2 gap-3 w-full max-w-sm">
                    <!-- KARTU 1: BANK BCA -->
                    <div class="relative bg-gradient-to-br from-white/95 to-sky-50/90 border border-white/60 p-4 rounded-2xl shadow-xl flex flex-col justify-between min-h-[160px] overflow-hidden">
                        <div class="flex justify-between items-start w-full z-20">
                            <div class="w-8 h-7 bg-gradient-to-br from-amber-400 via-yellow-200 to-amber-500 rounded-md border border-amber-600/40 relative shadow-inner">
                                <div class="absolute inset-1 border border-amber-700/20 grid grid-cols-3 gap-0.5 opacity-40"><div></div><div></div><div></div><div></div><div></div><div></div></div>
                            </div>
                            <div class="flex items-center gap-0.5 font-black text-blue-800 tracking-tighter text-sm italic"><span class="text-[10px] text-sky-500 font-bold not-italic">🔵</span>BCA</div>
                        </div>
                        <div class="w-full z-20 space-y-1 mt-4">
                            <p class="font-mono text-sm tracking-[0.15em] text-slate-800 font-bold" id="rek-bca">8420123456</p>
                            <p class="text-[11px] text-slate-600 font-medium">Anggita Rizki Syahwalia</p>
                        </div>
                        <div class="w-full z-20 pt-2">
                            <button onclick="salinTeks('rek-bca', this)" class="inline-flex items-center gap-1 bg-slate-500/80 hover:bg-slate-600 text-white text-[10px] font-semibold py-1 px-2.5 rounded-md shadow transition">📄 No. Rekening</button>
                        </div>
                    </div>
                    <!-- KARTU 2: DANA -->
                    <div class="relative bg-gradient-to-br from-white/95 to-sky-50/90 border border-white/60 p-4 rounded-2xl shadow-xl flex flex-col justify-between min-h-[160px] overflow-hidden">
                        <div class="flex justify-between items-start w-full z-20">
                            <div class="flex items-center gap-1 font-black text-sky-500 tracking-tight text-base italic uppercase"><span class="text-xs not-italic bg-sky-500 text-white w-4 h-4 rounded-full flex items-center justify-center font-sans">D</span>DANA</div>
                        </div>
                        <div class="w-full z-20 space-y-1 mt-6">
                            <p class="font-mono text-sm tracking-[0.15em] text-slate-800 font-bold" id="num-dana">085374410661</p>
                            <p class="text-[11px] text-slate-600 font-medium">Anggita Rizki Syahwalia</p>
                        </div>
                        <div class="w-full z-20 pt-2">
                            <button onclick="salinTeks('num-dana', this)" class="inline-flex items-center gap-1 bg-slate-500/80 hover:bg-slate-600 text-white text-[10px] font-semibold py-1 px-2.5 rounded-md shadow transition">📄 Salin Nomor</button>
                        </div>
                    </div>
                </div>

                <!-- CARD BARIS 3: ALAMAT KIRIM HADIAH -->
                <div class="relative w-full max-w-sm bg-gradient-to-br from-white/95 to-sky-50/90 border border-white/60 p-6 rounded-2xl shadow-xl text-center space-y-3 overflow-hidden">
                    <div class="flex justify-center z-20 relative">
                        <svg class="w-10 h-10 text-slate-800" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12h-4.07c-.43-.79-1.28-1.33-2.27-1.33s-1.84.54-2.27 1.33H10.4c-.43-.79-1.28-1.33-2.27-1.33s-1.84.54-2.27 1.33H2v5c0 1.105.895 2 2 2h16c1.105 0 2-.895 2-2v-5zM12 4c-1.84 0-3.37 1.29-3.8 3H4c-1.105 0-2 .895-2 2v2h20V9c0-1.105-.895-2-2-2h-4.2c-.43-1.71-1.96-3-3.8-3zm0 2c1.105 0 2 .895 2 2s-.895 2-2 2-2-.895-2-2 .895-2 2-2z"/></svg>
                    </div>
                    <h5 class="text-xs font-bold text-slate-800 uppercase tracking-widest z-20 relative">Kirim Hadiah</h5>
                    <div class="text-[11px] text-slate-600 font-sans leading-relaxed space-y-1 z-20 relative text-center" id="alamat-kado">
                        <p class="font-bold text-slate-800">Nama : Anggita Rizki Syahwalia</p>
                        <p>Alamat : Jl. Cinta Gg. Kasih No. 001</p>
                        <p>RT. 002 RW. 003, Tangerang</p>
                    </div>
                    <div class="pt-2 z-20 relative">
                        <button onclick="salinAlamatTeks('alamat-kado', this)" class="inline-flex items-center gap-1 bg-slate-500/80 hover:bg-slate-600 text-white text-[10px] font-semibold py-1.5 px-4 rounded-md shadow transition">📄 Salin Alamat</button>
                    </div>
                </div>
            </div>

            <!-- SUB-SECTION 2.6.2: FORM BERIKAN UCAPAN -->
            <div class="w-full flex flex-col items-center space-y-4 pt-4 efek-scroll">
                <div class="text-center text-white space-y-1">
                    <h4 class="font-wedding text-5xl tracking-wide">Berikan Ucapan</h4>
                    <p class="text-[11px] tracking-wide opacity-90">Berikan ucapan terbaik untuk kedua mempelai</p>
                </div>

                <div class="w-full max-w-sm bg-card-watercolor border border-white/60 shadow-xl p-5 space-y-4">
                    <div class="border-b border-slate-300 pb-2 flex justify-center items-center gap-1.5 text-slate-700 text-xs font-semibold">
                        <span>📩</span> <span>0 Ucapan</span>
                    </div>

                    @if(session('sukses'))
                        <div class="p-2 bg-emerald-100 text-emerald-800 text-xs font-medium text-center shadow-sm">
                            {{ session('sukses') }}
                        </div>
                    @endif

                    <form action="{{ url('/test-firestore') }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="w-full">
                            <input type="text" name="nama" value="{{ request('to') }}" placeholder="Nama Anda" required 
                                   class="w-full px-3 py-2 border border-slate-300 text-slate-700 text-xs focus:outline-none focus:ring-1 focus:ring-slate-400 bg-white placeholder-slate-400">
                        </div>
                        <div class="w-full relative">
                            <textarea name="pesan" rows="3" placeholder="Berikan Ucapan & Doa" required 
                                      class="w-full px-3 py-2 border border-slate-300 text-slate-700 text-xs focus:outline-none focus:ring-1 focus:ring-slate-400 bg-white placeholder-slate-400 resize-none"></textarea>
                            <span class="absolute bottom-1 right-2 text-[10px] text-slate-400">500</span>
                        </div>
                        
                        <div class="flex justify-start">
                            <button type="submit" class="bg-slate-600 hover:bg-slate-700 text-white text-xs font-medium py-2 px-5 rounded-md shadow transition duration-200">
                                Kirim
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SUB-SECTION 2.6.3: CARD FORMULIR RSVP -->
            <div class="w-full flex flex-col items-center pt-2 efek-scroll">
                <div class="w-full max-w-sm bg-card-watercolor border border-white/60 shadow-xl p-6 text-center space-y-4">
                    <p class="text-xs text-slate-700 font-medium leading-relaxed italic max-w-[285px] mx-auto">
                        Mari bantu kami mempersiapkan acara menjadi lebih baik dengan filling formulir RSVP dibawah ini
                    </p>
                    <div class="pt-1">
                        <button onclick="showToast('Fitur RSVP Siap Digunakan')" class="bg-slate-600 hover:bg-slate-700 text-white text-xs font-semibold py-2.5 px-6 rounded-2xl shadow-md transition duration-200">
                            Konfirmasi Kehadiran
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="w-full pt-16 pb-24 px-6 flex flex-col items-center mt-auto text-center relative overflow-hidden select-none bg-cover bg-center bg-no-repeat" 
             style="background-image: url('https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80');">
            
            <!-- OVERLAY: Efek warna biru transparan + blur tipis biar teks kebaca jelas (Persis elementor-background-overlay) -->
            <div class="absolute inset-0 bg-gradient-to-t from-sky-200/95 via-sky-100/90 to-sky-50/85 backdrop-blur-[2px] z-10"></div>

            <!-- KONTEN DI ATAS OVERLAY (Semua dikasih z-20) -->
            
            <!-- AYAT AR RUM -->
            <div class="relative z-20 text-center text-slate-700 space-y-3 mb-12 max-w-xs mx-auto efek-scroll">
                <p class="text-[12px] leading-relaxed italic font-serif text-slate-700">
                    "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-Nya diantaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat tanda-tanda bagi kaum yang berfikir."
                </p>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500">(Q.S Ar Rum : 21)</p>
            </div>

            <!-- FOTO PENUTUP BULAT -->
            <div class="relative z-20 w-56 h-56 rounded-full overflow-hidden border-4 border-white/90 shadow-lg mb-8 efek-scroll mx-auto">
                <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover" alt="Foto Penutup">
            </div>

            <!-- TEKS TERIMA KASIH -->
            <div class="relative z-20 max-w-xs mx-auto mb-6 efek-scroll">
                <p class="text-[13px] text-slate-800 italic font-serif leading-relaxed px-2 font-medium">
                    Atas kehadiran dan doa restu dari Bapak/Ibu/Saudara/i sekalian, kami mengucapkan Terima Kasih.
                </p>
            </div>

            <!-- WASSALAMUALAIKUM -->
            <div class="relative z-20 mb-8 efek-scroll">
                <h4 class="font-wedding text-4xl text-slate-800 tracking-wide font-normal">Wassalamualaikum Wr. Wb.</h4>
            </div>

            <!-- KAMI YANG BERBAHAGIA -->
            <div class="relative z-20 space-y-1 efek-scroll">
                <p class="text-[12px] italic text-slate-700 font-serif font-medium">Kami yang berbahagia</p>
                <!-- NAMA MEMPELAI -->
                <h3 class="font-wedding text-5xl text-slate-800 tracking-wide pt-1">Anggita & Roy</h3>
            </div>

        </div>
            
        <div class="w-full py-10 px-4 flex flex-col items-center justify-center space-y-4 text-center mt-auto border-t border-white/10" style="background-color: #5f839b;">
            
            <!-- Teks "Made with ♥ by" warna putih transparan tipis -->
            <div class="efek-scroll">
                <span class="text-xs font-light tracking-wide text-white/90 block">Made with ♥ by</span>
            </div>

            <!-- Logo Naradigital Menggunakan naradigitallogo.png -->
            <div class="w-20 h-20 efek-scroll">
                <img src="{{ asset('images/naradigitallogo.png') }}"
                     alt="Logo Nara Digital" 
                     class="w-full h-full object-contain mx-auto drop-shadow-md rounded-full bg-black" 
                     loading="lazy">
            </div>

            <!-- Teks Nama Brand Berubah Menjadi Nara Digital -->
            <div class="efek-scroll">
                <span class="text-sm font-bold tracking-wider text-white uppercase block">Naradigital</span>
            </div>

            <!-- Container Icon Media Sosial Bulat Putih Minimalis -->
            <div class="flex items-center justify-center gap-3 pt-1 efek-scroll">
                
                <!-- Tombol Instagram Bulat Putih -->
                <a href="https://www.instagram.com/undangan.digital.id/" 
                   target="_blank" 
                   class="bg-white text-[#5f839b] hover:bg-slate-100 p-2 rounded-full shadow-md transition duration-300 flex items-center justify-center w-8 h-8"
                   title="Instagram Nara Digital">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5 11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                    </svg>
                </a>

                <!-- Tombol WhatsApp Bulat Putih -->
                <a href="https://api.whatsapp.com/send/?phone=6285374410661&amp;text=Hai+Admin..%20info+harga+undangan+websitenya+dong" 
                   target="_blank" 
                   rel="nofollow"
                   class="bg-white text-[#5f839b] hover:bg-slate-100 p-2 rounded-full shadow-md transition duration-300 flex items-center justify-center w-8 h-8"
                   title="WhatsApp Admin">
                    <svg class="w-4 h-4 fill-current" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path>
                    </svg>
                </a>

            </div>

        </div>
    </div>

    <!-- ======================================================== -->
    <!-- 3. JAVASCRIPT SLIDE ANIMASI + MUSIK + PARTICLES + TIMER  -->
    <!-- ======================================================== -->
    <script>
        const lagu = document.getElementById('wedding-audio');
        const tombolMusik = document.getElementById('music-control');
        const iconMusik = document.getElementById('music-icon');

        function bukaUndangan() {
            const cover = document.getElementById('cover-page');
            const content = document.getElementById('main-content');
            content.classList.remove('hidden');
            cover.style.transform = 'translateY(-100%)';
            cover.style.opacity = '0';
            lagu.play().catch(function(error) { console.log("Autoplay diblokir."); });
            tombolMusik.classList.remove('hidden');
            aktifkanEfekScroll();
            setTimeout(function() { cover.style.display = 'none'; }, 1000);
        }

        function toggleMusik() {
            if (lagu.paused) { lagu.play(); iconMusik.classList.add('animate-spin-slow'); }
            else { lagu.pause(); iconMusik.classList.remove('animate-spin-slow'); }
        }

        function aktifkanEfekScroll() {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("muncul-aktif");
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });
            var elemenList = document.querySelectorAll(".efek-scroll");
            elemenList.forEach(function(el) { observer.observe(el); });
        }

        // INITIALIZATION CONFIG PARTICLES SALJU
        particlesJS('particles-js', {
            "particles": {
                "number": { "value": 60, "density": { "enable": true, "value_area": 800 } },
                "color": { "value": "#ffffff" },
                "shape": { "type": "circle" },
                "opacity": { "value": 0.8, "random": true },
                "size": { "value": 15, "random": true },
                "line_linked": { "enable": false },
                "move": { "enable": true, "speed": 1.5, "direction": "bottom", "out_mode": "out" }
            },
            "interactivity": { "detect_on": "canvas", "events": { "resize": true } },
            "retina_detect": true
        });

        // REAL-TIME COUNTDOWN TIMER (Target: 30 Desember 2026)
        const targetDate = new Date("December 30, 2026 08:00:00").getTime();
        const countdownInterval = setInterval(function() {
            const now = new Date().getTime();
            const distance = targetDate - now;
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Jaga-jaga kalau target lewat agar tidak minus
            if(distance < 0) {
                clearInterval(countdownInterval);
                return;
            }

            document.getElementById("days").innerText = days < 10 ? "0" + days : days;
            document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
            document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
            document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;
        }, 1000);

        // JAVASCRIPT SALIN NOMOR REKENING / DANA
        function salinTeks(elementId, btn) {
            const copyText = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(copyText).then(() => {
                showToast("Berhasil Disalin");
            });
        }

        // JAVASCRIPT SALIN ALAMAT SECARA UTUH PAKE BREAKLINE
        function salinAlamatTeks(elementId, btn) {
            const lines = document.getElementById(elementId).querySelectorAll("p");
            let fullText = "";
            lines.forEach((line) => { fullText += line.innerText + "\n"; });
            navigator.clipboard.writeText(fullText.trim()).then(() => {
                showToast("Alamat Berhasil Disalin");
            });
        }

        // FUNGSI TOAST NOTIFIKASI MUNCUL MELAYANG ALUS
        function showToast(message) {
            const toast = document.getElementById("toast-notif");
            toast.innerText = "✅ " + message + "!";
            toast.classList.remove("opacity-0", "-translate-y-2", "pointer-events-none");
            toast.classList.add("opacity-100", "translate-y-0");
            setTimeout(() => {
                toast.classList.remove("opacity-100", "translate-y-0");
                toast.classList.add("opacity-0", "-translate-y-2", "pointer-events-none");
            }, 2000);
        }

        // Ambil session laravel dengan aman tanpa merusak js murni
        var statusSukses = "{{ session('sukses') ? 'ada' : 'kosong' }}";
        if (statusSukses === 'ada') {
            document.getElementById('main-content').classList.remove('hidden');
            document.getElementById('cover-page').style.display = 'none';
            tombolMusik.classList.remove('hidden');
            setTimeout(aktifkanEfekScroll, 100);
        }
    </script>
</body>
</html>