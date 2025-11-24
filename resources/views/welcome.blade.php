<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome — Reservasi Muthe Café</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .bg-slider {
            animation: slide 8s infinite;
        }
        @keyframes slide {
            0%   { background-image: url("https://i.pinimg.com/1200x/f8/25/f8/f825f8ebacd9a063ddef4ef3fe2142a0.jpg"); }
            33%  { background-image: url("https://i.pinimg.com/736x/15/08/a4/1508a42f98823b22041f9ea66065eff7.jpg"); }
            66%  { background-image: url("https://i.pinimg.com/1200x/0d/1f/45/0d1f45779d25d3e8462a3768f440a1cb.jpg"); }
            100% { background-image: url("https://i.pinimg.com/1200x/b2/87/4c/b2874cf0a41c6b9dc9638d9139890326.jpg"); }
        }

        .scrolled {
            background: rgba(0,0,0,0.55) !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
        }
    </style>

    <script>
        document.addEventListener("scroll", () => {
            const nav = document.getElementById("navbar");
            window.scrollY > 30 ? nav.classList.add("scrolled") : nav.classList.remove("scrolled");
        });
    </script>
</head>

<body class="text-white">

@php
$bestImages = [
    "https://i.pinimg.com/1200x/b2/41/ba/b241ba6d024afa21328e70a1d6ba4dd2.jpg",
    "https://i.pinimg.com/736x/65/44/a4/6544a42c38b8d104fe89b0f712fbb1f9.jpg",
    "https://i.pinimg.com/736x/aa/67/94/aa67946a9845e2dd4dd72c5e2c110367.jpg",
];

$roomImages = [
    "https://i.pinimg.com/1200x/a2/b3/b8/a2b3b81f0844f79e2c14220252099b87.jpg",
    "https://i.pinimg.com/1200x/e6/01/cc/e601cce2f5f86e22606a2df3f3dbb15c.jpg",
    "https://i.pinimg.com/1200x/bd/e8/76/bde87657e7a05c79d9f694f5c686c05e.jpg",
];
@endphp

<header id="navbar" class="fixed w-full top-0 z-50 px-8 py-5 transition duration-300">

    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <div class="flex items-center gap-4">
            <img src="https://i.pinimg.com/736x/c8/6d/ee/c86dee95fa259987d41635ec3bfdd72b.jpg"
                 class="h-12 w-12 rounded-full shadow-[0_0_20px_rgba(255,193,7,0.5)]">
            <h1 class="text-3xl font-extrabold tracking-wide drop-shadow-[0_4px_10px_rgba(255,255,255,0.5)]">
                Muthe Café
            </h1>
        </div>

        <nav class="hidden md:flex gap-10 font-semibold text-lg">
            <a href="#best" class="hover:text-amber-300 hover:scale-105 transition">Best Seller</a>
            <a href="#ruangan" class="hover:text-amber-300 hover:scale-105 transition">Ruangan</a>
            <a href="#menus" class="hover:text-amber-300 hover:scale-105 transition">Menu</a>
        </nav>

        <a href="{{ route('login') }}" 
           class="px-6 py-2 bg-gradient-to-r from-amber-600 to-amber-500 hover:from-amber-500 hover:to-amber-400
                  shadow-[0_0_20px_rgba(255,193,7,0.5)] rounded-2xl font-semibold transition">
            Login
        </a>

    </div>
</header>


<section class="bg-slider bg-cover bg-center min-h-screen flex items-center justify-center relative">

    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm"></div>

    <div class="relative text-center fade-in max-w-3xl px-6">
        <h2 class="text-6xl font-extrabold drop-shadow-2xl leading-tight">Reservasi Ruangan Muthe Café</h2>
        <p class="mt-5 text-xl text-gray-200">Nikmati suasana hangat, eksklusif, dan nyaman.</p>

        <a href="{{ route('register') }}"
           class="mt-8 inline-block px-10 py-3 bg-amber-600 hover:bg-amber-500 text-white text-lg rounded-xl shadow-2xl">
            Daftar Sekarang
        </a>
    </div>
</section>

<section id="menus" class="py-20 bg-gradient-to-b from-gray-900 via-black to-gray-900 text-white">

    <div class="max-w-6xl mx-auto text-center mb-12">
        <h3 class="text-4xl font-bold">Daftar Menu Lengkap</h3>
        <p class="text-gray-300 mt-2 text-lg">Menu makanan & minuman favorit pelanggan Muthe Café</p>
    </div>

    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12">

        <div>
            <h4 class="text-3xl font-semibold mb-6 text-amber-300">🍽️ Makanan</h4>

            <div class="space-y-4">
                @foreach([
                    'Chicken Teriyaki Rice',
                    'Beef Blackpepper',
                    'Chicken Katsu Curry',
                    'Crispy Chicken Skin',
                    'French Fries & Mayo',
                    'Beef Burger Signature',
                    'Creamy Carbonara Pasta',
                ] as $food)
                <div class="flex justify-between bg-white/10 backdrop-blur-xl p-4 rounded-xl shadow-lg">
                    <span class="text-lg">{{ $food }}</span>
                    <span class="font-bold text-amber-300">Rp {{ rand(18000,35000) }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="text-3xl font-semibold mb-6 text-amber-300">🥤 Minuman</h4>

            <div class="space-y-4">
                @foreach([
                    'KukuBima Susu',
                    'Taro Milk Tea',
                    'Signature Cappuccino',
                    'Vanilla Cold Brew',
                    'Matcha Latte Creamy',
                    'Chocolate Frappe',
                    'Fresh Lemon Tea',
                ] as $drink)
                <div class="flex justify-between bg-white/10 backdrop-blur-xl p-4 rounded-xl shadow-lg">
                    <span class="text-lg">{{ $drink }}</span>
                    <span class="font-bold text-amber-300">Rp {{ rand(15000,32000) }}</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</section>

<section id="best" class="py-20 bg-gradient-to-b from-black via-gray-900 to-black">

    <div class="max-w-6xl mx-auto text-center">
        <h3 class="text-4xl font-bold mb-12">Menu Best Seller</h3>

        <div class="grid md:grid-cols-3 gap-10 px-6">

            @php
            $bestItems = [
                ['Caramel Latte', 28000, "https://i.pinimg.com/736x/65/44/a4/6544a42c38b8d104fe89b0f712fbb1f9.jpg"],
                ['Mocha Hazelnut', 32000, "https://i.pinimg.com/1200x/b2/41/ba/b241ba6d024afa21328e70a1d6ba4dd2.jpg"],
                ['Red Velvet Frappe', 30000, "https://i.pinimg.com/736x/aa/67/94/aa67946a9845e2dd4dd72c5e2c110367.jpg"],
                ['Waffle', 29000, "https://i.pinimg.com/736x/33/31/fb/3331fb6f261f2ca78d50c48b83e3b118.jpg"],
                ['Pancake', 27000, "https://i.pinimg.com/1200x/81/00/39/8100397ef3e98e13842711556d79d4e7.jpg"],
                ['Cheese Cake', 31000, "https://i.pinimg.com/1200x/de/a0/1a/dea01a87b4e0389b06ea43a19e6af30c.jpg"],
            ];
            @endphp

            @foreach($bestItems as $item)
            <div class="bg-white/10 backdrop-blur-xl p-6 rounded-3xl shadow-2xl hover:scale-105 transition">

                <img src="{{ $item[2] }}"
                     class="rounded-2xl w-full h-56 object-cover shadow-lg">

                <h4 class="mt-5 text-2xl font-semibold">{{ $item[0] }}</h4>
                <p class="text-amber-300 text-xl font-bold mt-2">
                    Rp {{ number_format($item[1]) }}
                </p>
            </div>
            @endforeach

        </div>
    </div>
</section>
        
<section id="ruangan" class="py-20 bg-black/80">

    <div class="max-w-6xl mx-auto text-center text-white">
        <h3 class="text-4xl font-bold mb-12">Ruangan Tersedia</h3>

        <div class="grid md:grid-cols-3 gap-10 px-6">

            @foreach([
                'Meeting Room',
                'Interior Room',
                'Rooftop ',
            ] as $i => $room)

            <div class="bg-white/10 backdrop-blur-xl p-6 rounded-3xl shadow-2xl hover:scale-105 transition">
                <img src="{{ $roomImages[$i] }}" 
                     class="rounded-xl w-full h-56 object-cover mb-4">
                <h4 class="text-2xl font-semibold">{{ $room }}</h4>
                <p class="text-gray-300 mt-2">Siap digunakan kapan saja.</p>
            </div>

            @endforeach

        </div>
        
    </div>
    
</section>
<footer class="bg-gray-950 text-gray-300 py-14 mt-20 border-t border-gray-800">

    <div class="max-w-7xl mx-auto grid md:grid-cols-4 gap-12 px-6">

        <div>
            <div class="flex items-center gap-3 mb-4">
                <img src="https://i.pinimg.com/736x/c8/6d/ee/c86dee95fa259987d41635ec3bfdd72b.jpg"
                     class="h-12 w-12 rounded-full shadow-[0_0_25px_rgba(255,193,7,0.6)]">
                <h2 class="text-2xl font-bold text-white">Muthe Café</h2>
            </div>
            <p class="text-gray-400 leading-relaxed">
                Reservasi ruangan premium dengan suasana nyaman, modern, dan eksklusif.
            </p>
        </div>

        <div>
            <h3 class="text-white font-semibold text-lg mb-4">Navigasi</h3>
            <ul class="space-y-3">
                <li><a href="/" class="hover:text-amber-300 transition">Home</a></li>
                <li><a href="#best" class="hover:text-amber-300 transition">Best Seller</a></li>
                <li><a href="#menus" class="hover:text-amber-300 transition">Menu</a></li>
                <li><a href="#ruangan" class="hover:text-amber-300 transition">Ruangan</a></li>
                <li><a href="/login" class="hover:text-amber-300 transition">Login</a></li>
                <li><a href="/register" class="hover:text-amber-300 transition">Register</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-white font-semibold text-lg mb-4">Kontak Kami</h3>
            <ul class="space-y-3">
                <li class="flex gap-2">📍 <span>Jl. Mawar No. 12, kaban Jahe</span></li>
                <li class="flex gap-2">☎ <span>0812 - 3456 - 7890</span></li>
                <li class="flex gap-2">✉ <span>reservasicafe@mail.com</span></li>
            </ul>
        </div>

    </div>

    <div class="text-center text-gray-500 mt-12 border-t border-gray-800 pt-6">
        © 2025 Reservasi Muthe Café — All rights reserved.
    </div>
</footer>

</body>
</html>
