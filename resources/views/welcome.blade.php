<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExamPro - Platform Tryout Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .bg-gradient {
            background: linear-gradient(90deg, #1a1a3a 0%, #0f172a 100%);
        }
        .glow {
            box-shadow: 0 0 15px rgba(74, 222, 255, 0.5);
        }
        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(74, 222, 255, 0.7);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        .neon-text {
            text-shadow: 0 0 10px rgba(74, 222, 255, 0.7);
        }
        .animation-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gradient text-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-blue-400 neon-text">ExamPro</span>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="hover:text-blue-400 transition duration-300">Beranda</a>
                <a href="#" class="hover:text-blue-400 transition duration-300">Fitur</a>
                <a href="#" class="hover:text-blue-400 transition duration-300">Paket</a>
                <a href="#" class="hover:text-blue-400 transition duration-300">Testimoni</a>
                <a href="#" class="hover:text-blue-400 transition duration-300">Kontak</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="px-4 py-2 rounded-full border border-blue-400 hover:bg-blue-400 hover:text-gray-900 transition duration-300">Masuk</a>
                <a href="#" class="px-4 py-2 bg-blue-500 rounded-full hover-glow transition duration-300">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto px-6 py-12 md:py-24 flex flex-col md:flex-row items-center">
        <div class="md:w-1/2">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight neon-text">Persiapan Ujian<br>di Era Digital</h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8">Platform tryout interaktif dengan teknologi AI untuk hasil ujian yang maksimal</p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="#" class="px-8 py-3 bg-blue-600 rounded-full text-center hover-glow transition duration-300 text-lg">Mulai Tryout Gratis</a>
                <a href="#" class="px-8 py-3 bg-transparent border border-blue-400 rounded-full text-center hover:bg-blue-400 hover:text-gray-900 transition duration-300 text-lg">Lihat Demo</a>
            </div>
        </div>
        <div class="md:w-1/2 mt-12 md:mt-0 flex justify-center">
            <img src="/api/placeholder/500/400" alt="Ilustrasi Tryout Online" class="rounded-lg glow animation-float">
        </div>
    </section>

    <!-- Stats -->
    <section class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-4"><i class="fas fa-users"></i></div>
                <h3 class="text-4xl font-bold mb-2">50,000+</h3>
                <p class="text-gray-400">Peserta Aktif</p>
            </div>
            <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-4"><i class="fas fa-book"></i></div>
                <h3 class="text-4xl font-bold mb-2">1,000+</h3>
                <p class="text-gray-400">Soal Berkualitas</p>
            </div>
            <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-4"><i class="fas fa-chart-line"></i></div>
                <h3 class="text-4xl font-bold mb-2">85%</h3>
                <p class="text-gray-400">Peningkatan Nilai</p>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="container mx-auto px-6 py-12">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 neon-text">Fitur Unggulan Kami</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">Rasakan pengalaman tryout yang berbeda dengan teknologi terkini</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-6"><i class="fas fa-robot"></i></div>
                <h3 class="text-2xl font-bold mb-4">Analisis AI</h3>
                <p class="text-gray-300">Dapatkan analisis mendalam tentang kekuatan dan kelemahan Anda melalui teknologi kecerdasan buatan</p>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-6"><i class="fas fa-clock"></i></div>
                <h3 class="text-2xl font-bold mb-4">Simulasi Waktu Nyata</h3>
                <p class="text-gray-300">Rasakan suasana ujian sebenarnya dengan pengaturan waktu yang presisi</p>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-6"><i class="fas fa-chart-pie"></i></div>
                <h3 class="text-2xl font-bold mb-4">Laporan Detail</h3>
                <p class="text-gray-300">Dapatkan laporan hasil tryout yang komprehensif dan rekomendasi untuk peningkatan</p>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-6"><i class="fas fa-laptop"></i></div>
                <h3 class="text-2xl font-bold mb-4">Multi Platform</h3>
                <p class="text-gray-300">Akses dari berbagai perangkat: laptop, tablet, atau smartphone</p>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-6"><i class="fas fa-graduation-cap"></i></div>
                <h3 class="text-2xl font-bold mb-4">Materi Pembelajaran</h3>
                <p class="text-gray-300">Dilengkapi dengan materi pembelajaran dan pembahasan soal yang mendalam</p>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-blue-400 text-4xl mb-6"><i class="fas fa-users"></i></div>
                <h3 class="text-2xl font-bold mb-4">Peringkat Nasional</h3>
                <p class="text-gray-300">Bandingkan kemampuan Anda dengan peserta lain dari seluruh Indonesia</p>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="container mx-auto px-6 py-12">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 neon-text">Pilih Paket Sesuai Kebutuhan</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">Investasi terbaik untuk masa depan akademik Anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-center">
                    <h3 class="text-2xl font-bold mb-2">Paket Dasar</h3>
                    <div class="text-blue-400 text-5xl font-bold my-6">Gratis</div>
                    <ul class="text-left space-y-3 mb-8">
                        <li><i class="fas fa-check text-green-400 mr-2"></i> 5 Tryout Gratis</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Pembahasan Soal</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Peringkat Nasional</li>
                        <li class="text-gray-500"><i class="fas fa-times text-red-400 mr-2"></i> Analisis AI</li>
                        <li class="text-gray-500"><i class="fas fa-times text-red-400 mr-2"></i> Laporan Detail</li>
                    </ul>
                    <a href="#" class="block w-full py-3 rounded-full border border-blue-400 text-center hover:bg-blue-400 hover:text-gray-900 transition duration-300">Daftar Sekarang</a>
                </div>
            </div>
            <div class="bg-blue-900 bg-opacity-30 p-8 rounded-xl glow transition duration-300 transform scale-105">
                <div class="text-center">
                    <span class="bg-blue-500 text-xs px-2 py-1 rounded-full uppercase font-bold">Terpopuler</span>
                    <h3 class="text-2xl font-bold mt-4 mb-2">Paket Premium</h3>
                    <div class="text-blue-400 text-5xl font-bold my-6">Rp199.000</div>
                    <p class="text-sm text-gray-400 mb-6">per 3 bulan</p>
                    <ul class="text-left space-y-3 mb-8">
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Tryout Tidak Terbatas</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Pembahasan Detail</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Peringkat Nasional</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Analisis AI Basic</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Laporan Detail</li>
                    </ul>
                    <a href="#" class="block w-full py-3 bg-blue-500 rounded-full text-center hover-glow transition duration-300">Daftar Sekarang</a>
                </div>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="text-center">
                    <h3 class="text-2xl font-bold mb-2">Paket Ultimate</h3>
                    <div class="text-blue-400 text-5xl font-bold my-6">Rp499.000</div>
                    <p class="text-sm text-gray-400 mb-6">per 6 bulan</p>
                    <ul class="text-left space-y-3 mb-8">
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Tryout Tidak Terbatas</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Pembahasan Detail</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Peringkat Nasional</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Analisis AI Advanced</li>
                        <li><i class="fas fa-check text-green-400 mr-2"></i> Konsultasi dengan Tutor</li>
                    </ul>
                    <a href="#" class="block w-full py-3 rounded-full border border-blue-400 text-center hover:bg-blue-400 hover:text-gray-900 transition duration-300">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="container mx-auto px-6 py-12">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 neon-text">Apa Kata Mereka?</h2>
            <p class="text-xl text-gray-300 max-w-3xl mx-auto">Kisah sukses dari para pengguna ExamPro</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="flex items-center mb-4">
                    <img src="/api/placeholder/60/60" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold">Dian Sastro</h4>
                        <p class="text-gray-400 text-sm">Siswa SMAN 1 Jakarta</p>
                    </div>
                </div>
                <p class="text-gray-300">"Berkat ExamPro, nilai UTBK saya meningkat signifikan. Analisis AI-nya sangat membantu mengidentifikasi kelemahan saya."</p>
                <div class="text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="flex items-center mb-4">
                    <img src="/api/placeholder/60/60" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold">Ahmad Rizki</h4>
                        <p class="text-gray-400 text-sm">Siswa SMA 5 Bandung</p>
                    </div>
                </div>
                <p class="text-gray-300">"Simulasi ujiannya sangat mirip dengan UTBK. Saya jadi lebih siap dan tidak kaget saat menghadapi ujian sungguhan."</p>
                <div class="text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
            </div>
            <div class="bg-gray-800 bg-opacity-30 p-8 rounded-xl hover-glow transition duration-300">
                <div class="flex items-center mb-4">
                    <img src="/api/placeholder/60/60" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <h4 class="font-bold">Siti Nurhaliza</h4>
                        <p class="text-gray-400 text-sm">Siswa SMAN 2 Surabaya</p>
                    </div>
                </div>
                <p class="text-gray-300">"Laporan detailnya sangat membantu. Saya bisa fokus belajar di area yang lemah dan berhasil masuk jurusan impian."</p>
                <div class="text-yellow-400 mt-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="container mx-auto px-6 py-12">
        <div class="bg-blue-900 bg-opacity-30 rounded-2xl p-12 text-center glow">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 neon-text">Siap Untuk Meraih Nilai Terbaik?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Bergabung dengan ribuan siswa yang telah sukses mencapai target akademiknya bersama ExamPro</p>
            <a href="#" class="px-8 py-4 bg-blue-500 rounded-full text-lg hover-glow transition duration-300 inline-block">Mulai Tryout Gratis</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-blue-400 mb-4 neon-text">ExamPro</h3>
                    <p class="text-gray-400">Platform tryout online terbaik dengan teknologi AI untuk kesuksesan ujian Anda</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Tryout Online</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Bank Soal</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Konsultasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Kelas Premium</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Tim</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Karir</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i class="fas fa-envelope text-blue-400 mr-2"></i> <a href="mailto:info@exampro.id" class="text-gray-400 hover:text-blue-400 transition duration-300">info@exampro.id</a></li>
                        <li class="flex items-center"><i class="fas fa-phone text-blue-400 mr-2"></i> <a href="tel:+6281234567890" class="text-gray-400 hover:text-blue-400 transition duration-300">+62 812-3456-7890</a></li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt text-blue-400 mr-2"></i> <span class="text-gray-400">Jakarta, Indonesia</span></li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition duration-300"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-gray-500">
                <p>&copy; 2025 ExamPro. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation on scroll
        window.addEventListener('scroll', function() {
            const elements = document.querySelectorAll('.hover-glow');
            elements.forEach(element => {
                const position = element.getBoundingClientRect();
                if(position.top < window.innerHeight && position.bottom >= 0) {
                    element.classList.add('opacity-100');
                    element.classList.remove('opacity-70');
                }
            });
        });
    </script>
</body>
</html>