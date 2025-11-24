@extends('layouts.app')

@section('title', 'Manajemen Ruangan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-white drop-shadow-lg">Manajemen Ruangan</h1>
        <p class="text-white/80">Kelola ruangan cafe untuk reservasi</p>
    </div>
    <a href="{{ route('ruangans.create') }}" class="bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg border-2 border-amber-400 transition duration-300 transform hover:scale-105">
        Tambah Ruangan
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($ruangans as $ruangan)
    <div class="bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl overflow-hidden border-4 border-amber-600 transform hover:scale-105 transition duration-300">
        @if($ruangan->foto)
            <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="{{ $ruangan->nama }}" class="w-full h-48 object-cover">
        @else
            <div class="w-full h-48 bg-gradient-to-br from-amber-300 to-orange-400 flex items-center justify-center">
                <span class="text-white text-4xl">📍</span>
            </div>
        @endif
        
        <div class="p-6">
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $ruangan->nama }}</h3>
                    <span class="inline-block mt-1 px-2 py-1 text-xs rounded-full font-bold
                        @if($ruangan->tipe == 'interior') bg-blue-100 text-blue-800
                        @elseif($ruangan->tipe == 'rooftop') bg-green-100 text-green-800
                        @else bg-purple-100 text-purple-800
                        @endif">
                        @if($ruangan->tipe == 'interior') 🏠 Interior
                        @elseif($ruangan->tipe == 'rooftop') 🌤️ Rooftop
                        @else 💼 Meeting Room
                        @endif
                    </span>
                </div>
                <span class="px-3 py-1 text-xs rounded-full font-bold {{ $ruangan->status == 'tersedia' ? 'bg-green-100 text-green-800 border border-green-300' : 'bg-red-100 text-red-800 border border-red-300' }}">
                    {{ ucfirst($ruangan->status) }}
                </span>
            </div>
            
            <p class="text-gray-600 text-sm mb-2 mt-3">{{ Str::limit($ruangan->deskripsi, 100) }}</p>
            
            <div class="flex items-center text-sm text-gray-500 mb-4">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Kapasitas: {{ $ruangan->kapasitas }} orang
            </div>
            
            <div class="flex gap-2">
                <a href="{{ route('ruangans.edit', $ruangan) }}" class="flex-1 text-center bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 border border-yellow-300">
                    Edit
                </a>
                <form action="{{ route('ruangans.destroy', $ruangan) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition duration-300 border border-red-300" 
                        onclick="return confirm('Yakin ingin menghapus ruangan ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12">
        <div class="bg-white/90 backdrop-blur-md rounded-2xl p-8 border-4 border-amber-600">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="text-xl font-bold text-gray-700 mb-2">Belum Ada Ruangan</h3>
            <p class="text-gray-500">Tambahkan ruangan pertama Anda untuk memulai</p>
        </div>
    </div>
    @endforelse
</div>
@endsection