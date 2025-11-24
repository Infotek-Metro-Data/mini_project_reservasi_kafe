<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Reservasi Muthe Café</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        body {
            @auth
                @if(auth()->user()->role->name == 'admin')
                    background-image: url("https://i.pinimg.com/1200x/93/2a/04/932a04ed532b4b09c69effc40018d666.jpg");
                @elseif(auth()->user()->role->name == 'petugas')
                    background-image: url("https://i.pinimg.com/1200x/87/70/8e/87708ee45a7bf978a1a86b5820ce9e65.jpg");
                @else
                    background-image: url("https://i.pinimg.com/736x/72/72/29/7272291661b2f40f0b4a280150694ba6.jpg");
                @endif
            @else
                background-image: url('https://i.pinimg.com/1200x/92/65/75/926575fc649b89595eaec8aa93c548b2.jpg');
            @endauth
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

       
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(3px);
            z-index: -1;
        }
    </style>
</head>

<body class="min-h-screen font-sans tracking-wide">

    
    @auth
    <nav class="bg-black/30 backdrop-blur-xl shadow-2xl sticky top-0 z-50 border-b border-amber-500/40">

        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">

             
                <div class="flex items-center space-x-3">
                    <div class="bg-white/10 rounded-full border border-amber-400/40 shadow-md backdrop-blur-lg flex items-center justify-center">
                 <img src="https://i.pinimg.com/736x/21/9f/16/219f16068281407c8b1a8cc0c046de37.jpg"
                  class="w-7 h-7 rounded-full" alt="logo">
                </div>

                    <span class="text-xl font-bold text-white drop-shadow-md">
                        Muthe Café Reservasi
                    </span>
                </div>

               
                <div class="flex items-center space-x-2">

                    <a href="{{ route('dashboard') }}"
                       class="px-4 py-2 text-white font-semibold rounded-lg hover:bg-white/10 transition">
                       Dashboard
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('users.index') }}"
                           class="px-4 py-2 text-white font-semibold rounded-lg hover:bg-white/10 transition">
                           Users
                        </a>
                    @endif

                    @if(auth()->user()->isAdmin() || auth()->user()->isPetugas())
                        <a href="{{ route('ruangans.index') }}"
                           class="px-4 py-2 text-white font-semibold rounded-lg hover:bg-white/10 transition">
                           Ruangan
                        </a>
                    @endif

                    <a href="{{ route('reservasis.index') }}"
                       class="px-4 py-2 text-white font-semibold rounded-lg hover:bg-white/10 transition">
                       Reservasi
                    </a>

                    
                    <div class="flex items-center space-x-4 bg-white/10 px-4 py-2 rounded-full backdrop-blur-xl border border-white/20 shadow-lg">

                      
                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                class="w-9 h-9 rounded-full shadow-md border-2 border-amber-300/70 object-cover">
                        @else
                            <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center shadow-md">
                                <span class="font-bold text-amber-900 text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                        @endif

                     
                        <span class="text-white font-semibold">{{ auth()->user()->name }}</span>

                       
                        <span class="px-3 py-1 text-xs font-bold rounded-full shadow-lg
                            @if(auth()->user()->role->name == 'admin') bg-yellow-400 text-yellow-900
                            @elseif(auth()->user()->role->name == 'petugas') bg-blue-400 text-blue-900
                            @else bg-green-400 text-green-900
                            @endif">
                            {{ strtoupper(auth()->user()->role->name) }}
                        </span>

                        
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="text-white hover:text-red-400 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                            </button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </nav>
    @endauth


    
    <main class="py-10">
        <div class="max-w-7xl mx-auto px-4">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/20 border-l-4 border-green-400 text-white rounded-xl backdrop-blur-xl shadow-xl">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"/></svg>
                        <span class="font-bold">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/20 border-l-4 border-red-400 text-white rounded-xl backdrop-blur-xl shadow-xl">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor"><path d="M10 18a8 8 0 100-16 8 8 0 000 16z"/></svg>
                        <span class="font-bold">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>


   
    <footer class="bg-black/40 backdrop-blur-xl text-white py-8 border-t border-amber-500/40 shadow-inner mt-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-white/80 tracking-wide">© Muthe Café Reservasi System — Premium Edition</p>
        </div>
    </footer>

</body>
</html>
