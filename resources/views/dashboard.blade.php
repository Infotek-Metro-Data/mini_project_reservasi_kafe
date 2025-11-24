@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


@if(auth()->user()->isAdmin())

<div class="space-y-6">
    <div class="bg-gradient-to-r from-purple-600 via-pink-600 to-purple-700 rounded-3xl shadow-2xl p-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
            <div class="flex items-center space-x-4">
                <div class="bg-white/20 backdrop-blur-md p-4 rounded-2xl">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white">Panel Administrator</h1>
                    <p class="text-purple-100">Monitor Reservasi & Kelola User</p>
                </div>
            </div>
            <div class="relative">
                <input type="text" placeholder="Cari data..." class="pl-12 pr-4 py-3 rounded-xl border-0 focus:ring-2 focus:ring-white/50 w-full md:w-80 shadow-lg">
                <svg class="w-6 h-6 text-gray-400 absolute left-4 top-1/2 transform -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start mb-3">
                <p class="text-sm opacity-90">Ruangan Kosong</p>
                <div class="bg-white/20 p-2 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold">5</p>
        </div>

        <div class="bg-gradient-to-br from-red-500 to-pink-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start mb-3">
                <p class="text-sm opacity-90">Ruangan Terisi</p>
                <div class="bg-white/20 p-2 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold">3</p>
        </div>

        <div class="bg-gradient-to-br from-yellow-500 to-orange-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start mb-3">
                <p class="text-sm opacity-90">Perlu Verifikasi</p>
                <div class="bg-white/20 p-2 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold">{{ $reservasiPending }}</p>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl shadow-lg p-6 text-white transform hover:scale-105 transition duration-300">
            <div class="flex justify-between items-start mb-3">
                <p class="text-sm opacity-90">Total Ruangan</p>
                <div class="bg-white/20 p-2 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
            </div>
            <p class="text-4xl font-bold">{{ $totalRuangan }}</p>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <span class="bg-purple-600 w-2 h-8 rounded-full mr-3"></span>
            Status Ruangan Real-Time
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-green-500">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">🏠 Interior Room A</h3>
                    <span class="px-3 py-1 bg-green-500 text-white text-xs font-bold rounded-full">KOSONG</span>
                </div>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Kapasitas:</span>
                        <span class="font-semibold text-gray-800">10 Orang</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Next Booking:</span>
                        <span class="font-semibold text-gray-800">15:00</span>
                    </div>
                </div>
                <div class="w-full bg-gray-100 rounded-lg h-2 mt-4 overflow-hidden">
                    <div class="bg-green-500 h-2 rounded-lg" style="width: 0%"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-red-500">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">🌤️ Rooftop Garden</h3>
                    <span class="px-3 py-1 bg-red-500 text-white text-xs font-bold rounded-full">TERISI</span>
                </div>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Pelanggan:</span>
                        <span class="font-semibold text-gray-800">Siti N.</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Check-Out:</span>
                        <span class="font-semibold text-red-600">16:00</span>
                    </div>
                </div>
                <div class="w-full bg-gray-100 rounded-lg h-2 mt-4 overflow-hidden">
                    <div class="bg-red-500 h-2 rounded-lg" style="width: 80%"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-6 border-t-4 border-yellow-500">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-gray-800">💼 Meeting Room B</h3>
                    <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full">MENUNGGU</span>
                </div>
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Pelanggan:</span>
                        <span class="font-semibold text-gray-800">Budi S.</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Check-In:</span>
                        <span class="font-semibold text-yellow-600">16:00</span>
                    </div>
                </div>
                <div class="w-full bg-gray-100 rounded-lg h-2 mt-4 overflow-hidden">
                    <div class="bg-yellow-500 h-2 rounded-lg" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
            <span class="bg-blue-600 w-2 h-8 rounded-full mr-3"></span>
            Menu Cepat Admin
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('users.index') }}" class="bg-white hover:bg-indigo-50 rounded-2xl shadow-lg p-6 transition duration-300 border-l-4 border-indigo-500 group">
                <div class="flex items-center space-x-4">
                    <div class="bg-indigo-100 p-4 rounded-xl group-hover:bg-indigo-200 transition">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Kelola Users</h3>
                        <p class="text-sm text-gray-600">Manajemen Pengguna</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('ruangans.index') }}" class="bg-white hover:bg-purple-50 rounded-2xl shadow-lg p-6 transition duration-300 border-l-4 border-purple-500 group">
                <div class="flex items-center space-x-4">
                    <div class="bg-purple-100 p-4 rounded-xl group-hover:bg-purple-200 transition">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Kelola Ruangan</h3>
                        <p class="text-sm text-gray-600">Update status & info</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('reservasis.index') }}" class="bg-white hover:bg-pink-50 rounded-2xl shadow-lg p-6 transition duration-300 border-l-4 border-pink-500 group">
                <div class="flex items-center space-x-4">
                    <div class="bg-pink-100 p-4 rounded-xl group-hover:bg-pink-200 transition">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Verifikasi</h3>
                        <p class="text-sm text-gray-600">Approve/Reject</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('ruangans.create') }}" class="bg-white hover:bg-blue-50 rounded-2xl shadow-lg p-6 transition duration-300 border-l-4 border-blue-500 group">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-100 p-4 rounded-xl group-hover:bg-blue-200 transition">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Tambah Ruang</h3>
                        <p class="text-sm text-gray-600">Ruangan baru</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@elseif(auth()->user()->isKaryawan())

<div class="space-y-6">
    <div class="bg-gradient-to-r from-blue-500 via-cyan-500 to-blue-600 rounded-3xl shadow-2xl p-8">
        <div class="flex items-center space-x-4">
            <div class="bg-white/20 backdrop-blur-md p-4 rounded-2xl">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-white">Dashboard Karyawan</h1>
                <p class="text-blue-100 text-lg">Halo, {{ auth()->user()->name }}! Kelola reservasi Anda di sini 🎯</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300 border-t-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Reservasi Saya</p>
                    <p class="text-4xl font-bold text-blue-600">{{ $totalReservasi }}</p>
                    <p class="text-xs text-gray-500 mt-2">Total booking</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-full">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300 border-t-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Disetujui</p>
                    <p class="text-4xl font-bold text-green-600">{{ $reservasiDisetujui }}</p>
                    <p class="text-xs text-gray-500 mt-2">Reservasi aktif</p>
                </div>
                <div class="bg-green-100 p-4 rounded-full">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6 hover:shadow-2xl transition duration-300 border-t-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Menunggu</p>
                    <p class="text-4xl font-bold text-yellow-600">{{ $reservasiPending }}</p>
                    <p class="text-xs text-gray-500 mt-2">Perlu approve</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-full">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('reservasis.create') }}" class="group bg-gradient-to-br from-green-400 to-emerald-600 hover:from-green-500 hover:to-emerald-700 rounded-3xl shadow-2xl p-10 transition duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">Buat Reservasi Baru</h3>
                    <p class="text-green-100">Booking ruangan untuk kebutuhan Anda</p>
                </div>
                <div class="bg-white/20 p-5 rounded-2xl group-hover:bg-white/30 transition duration-300">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            </div>
        </a>

        <a href="{{ route('reservasis.index') }}" class="group bg-gradient-to-br from-blue-400 to-cyan-600 hover:from-blue-500 hover:to-cyan-700 rounded-3xl shadow-2xl p-10 transition duration-300 transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">Lihat Reservasi Saya</h3>
                    <p class="text-blue-100">Cek status dan riwayat booking</p>
                </div>
                <div class="bg-white/20 p-5 rounded-2xl group-hover:bg-white/30 transition duration-300">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </a>
    </div>
</div>

@else

<div class="space-y-6">
    <div class="relative bg-gradient-to-r from-amber-900 via-orange-800 to-amber-900 rounded-3xl overflow-hidden shadow-2xl">
        <div class="absolute inset-0 opacity-20">
            <img src="" class="w-full h-full object-cover">
        </div>
        <div class="relative p-8">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <div class="bg-yellow-400 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-amber-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-4xl font-bold text-white">Panel Petugas</h1>
                            <p class="text-amber-200">Kontrol operasional reservasi cafe</p>
                        </div>
                    </div>
                    <p class="text-white/80 text-lg">Selamat datang, <strong>{{ auth()->user()->name }}</strong> 👋</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-2xl transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-blue-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-blue-600">{{ $totalRuangan }}</span>
            </div>
            <h3 class="text-gray-700 font-semibold">Total Ruangan</h3>
            <p class="text-sm text-gray-500 mt-1">Semua ruangan aktif</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-2xl transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-green-600">{{ $totalReservasi }}</span>
            </div>
            <h3 class="text-gray-700 font-semibold">Total Reservasi</h3>
            <p class="text-sm text-gray-500 mt-1">Semua periode</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-yellow-500 hover:shadow-2xl transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-yellow-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-yellow-600">{{ $reservasiPending }}</span>
            </div>
            <h3 class="text-gray-700 font-semibold">Menunggu Approve</h3>
            <p class="text-sm text-gray-500 mt-1">Butuh verifikasi</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-2xl transition duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-purple-100 p-3 rounded-xl">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-gray-700 font-semibold">Pelanggan</h3>
            <p class="text-sm text-gray-500 mt-1">Status Sistem</p>
        </div>
    </div>

    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">⚡ Quick Actions</h3>
        <div class="space-y-3">

            <a href="{{ route('ruangans.index') }}" class="block bg-white hover:bg-amber-50 p-4 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-500 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Kelola Ruangan</p>
                        <p class="text-xs text-gray-500">Update ketersediaan ruangan</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('reservasis.index') }}" class="block bg-white hover:bg-amber-50 p-4 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-500 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Lihat Reservasi</p>
                        <p class="text-xs text-gray-500">Monitor booking masuk</p>
                    </div>
                </div>
            </a>

            <a href="#" class="block bg-white hover:bg-amber-50 p-4 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                <div class="flex items-center space-x-3">
                    <div class="bg-purple-500 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">Laporan</p>
                        <p class="text-xs text-gray-500">Download report</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endif
@endsection