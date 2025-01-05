<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Streaming Site</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900">
    <!-- Header -->
    <header class="bg-red-800 text-white px-44">
        <div class="container mx-auto py-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <img src="https://s7.lk21static.buzz/wp-content/themes/dunia21/images/logo-layarkaca21.svg" alt="" class="w-[200px]">
                    <div class="relative">
                        <input type="text" placeholder="Cari film, artis, imdb" 
                               class="px-4 py-1 w-64 text-white bg-transparent border focus:outline-none focus:border-gray-700 placeholder:text-white">
                        <button class="absolute right-2 mt-[6px]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="space-x-4">
                    <a href="#" class="text-sm">720P</a>
                    <a href="#" class="text-sm">1080P</a>
                    <a href="#" class="text-sm">DMCA</a>
                    <a href="#" class="text-sm">REQUEST MOVIE</a>
                    <a href="#" class="text-sm">FAQ</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="bg-pink-600 text-white">
        <div class="container mx-auto px-4 py-2">
            <div class="flex items-center justify-between">
                <div class="space-x-4">
                    <a href="#" class="text-sm">🏠 Home</a>
                    <a href="#" class="text-sm">📁 Genre</a>
                    <a href="#" class="text-sm">💜 Series</a>
                    <a href="#" class="text-sm">⭐ Populer</a>
                    <a href="#" class="text-sm">🌐 Negara</a>
                    <a href="#" class="text-sm">📅 Tahun</a>
                </div>
                <div class="space-x-4">
                    <a href="#" class="bg-pink-500 px-3 py-1 rounded">📋 Playlist</a>
                    <a href="#" class="bg-pink-500 px-3 py-1 rounded">👍 Rekomendasi</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Categories -->
    <div class="bg-yellow-500">
        <div class="container mx-auto px-4 py-2">
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="#" class="text-sm">ACTION</a>
                <a href="#" class="text-sm">ANIME</a>
                <a href="#" class="text-sm">HORROR</a>
                <a href="#" class="text-sm">SCI-FI</a>
                <a href="#" class="text-sm">KOMEDI</a>
                <a href="#" class="text-sm">ROMANCE</a>
                <a href="#" class="text-sm">MANDARIN</a>
                <a href="#" class="text-sm">INDIA</a>
                <a href="#" class="text-sm">JEPANG</a>
                <a href="#" class="text-sm">KOREA</a>
                <a href="#" class="text-sm">THAILAND</a>
                <a href="#" class="text-sm">2023</a>
                <a href="#" class="text-sm">2024</a>
                <a href="#" class="text-sm">BLURAY</a>
                <a href="#" class="text-sm">TERPOPULER</a>
            </div>
        </div>
    </div>

    <!-- Social Media Buttons -->
    <div class="container mx-auto px-4 py-4">
        <div class="flex gap-2">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Facebook</button>
            <button class="bg-blue-400 text-white px-4 py-2 rounded">Twitter</button>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Telegram</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded">Whatsapp</button>
        </div>
    </div>

    <!-- Movie Grid -->
    <div class="container mx-auto px-4 py-4">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4">
            <!-- Movie Card Template -->
            <div class="relative group">
                <div class="relative">
                    <img src="/api/placeholder/200/300" alt="Movie Poster" class="w-full rounded-lg">
                    <div class="absolute top-2 right-2 bg-yellow-500 text-black px-2 py-1 rounded text-sm">8.0</div>
                    <div class="absolute top-2 left-2 bg-pink-600 text-white px-2 py-1 rounded text-sm">EPS 8</div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black p-2">
                        <h3 class="text-white text-sm font-medium">Movie Title (2024)</h3>
                    </div>
                </div>
            </div>
            <!-- Repeat movie cards as needed -->
        </div>
    </div>

    <!-- View All Button -->
    <div class="text-center py-4">
        <button class="bg-pink-600 text-white px-6 py-2 rounded-lg">LIHAT SEMUA FILM UNGGULAN</button>
    </div>

    <!-- Promotional Banners -->
    <div class="container mx-auto px-4 py-4 grid md:grid-cols-2 gap-4">
        <div class="bg-blue-900 rounded-lg p-4">
            <img src="/api/placeholder/800/200" alt="Promo Banner 1" class="w-full">
        </div>
        <div class="bg-blue-900 rounded-lg p-4">
            <img src="/api/placeholder/800/200" alt="Promo Banner 2" class="w-full">
        </div>
    </div>
</body>
</html>