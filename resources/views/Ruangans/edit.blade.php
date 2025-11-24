@extends('layouts.app')

@section('title', 'Edit Ruangan')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-white drop-shadow-lg">Edit Ruangan</h1>
</div>

<div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 max-w-2xl border-4 border-amber-600">
    <form action="{{ route('ruangans.update', $ruangan) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Meja</label>
            <input type="text" name="nama" value="{{ old('nama', $ruangan->nama) }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('nama') border-red-500 @enderror" 
                required>
            @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

    
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe Ruangan</label>
            <div class="grid grid-cols-3 gap-3">
                <label class="relative cursor-pointer">
                    <input type="radio" name="tipe" value="interior" class="peer sr-only" {{ old('tipe', $ruangan->tipe) == 'interior' ? 'checked' : '' }} required>
                    <div class="p-4 border-2 border-gray-300 rounded-xl text-center transition-all duration-200
                        peer-checked:border-amber-600 peer-checked:bg-amber-50 peer-checked:shadow-lg
                        hover:border-amber-400 hover:shadow-md">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                                <span class="text-2xl">🏠</span>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Interior</span>
                        </div>
                    </div>
                </label>

                <label class="relative cursor-pointer">
                    <input type="radio" name="tipe" value="rooftop" class="peer sr-only" {{ old('tipe', $ruangan->tipe) == 'rooftop' ? 'checked' : '' }} required>
                    <div class="p-4 border-2 border-gray-300 rounded-xl text-center transition-all duration-200
                        peer-checked:border-amber-600 peer-checked:bg-amber-50 peer-checked:shadow-lg
                        hover:border-amber-400 hover:shadow-md">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center">
                                <span class="text-2xl">🌤️</span>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Rooftop</span>
                        </div>
                    </div>
                </label>

                <label class="relative cursor-pointer">
                    <input type="radio" name="tipe" value="meeting_room" class="peer sr-only" {{ old('tipe', $ruangan->tipe) == 'meeting_room' ? 'checked' : '' }} required>
                    <div class="p-4 border-2 border-gray-300 rounded-xl text-center transition-all duration-200
                        peer-checked:border-amber-600 peer-checked:bg-amber-50 peer-checked:shadow-lg
                        hover:border-amber-400 hover:shadow-md">
                        <div class="flex flex-col items-center space-y-2">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                                <span class="text-2xl">💼</span>
                            </div>
                            <span class="text-xs font-bold text-gray-700">Meeting Room</span>
                        </div>
                    </div>
                </label>
            </div>
            @error('tipe')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('deskripsi') border-red-500 @enderror" 
                required>{{ old('deskripsi', $ruangan->deskripsi) }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kapasitas</label>
            <input type="number" name="kapasitas" value="{{ old('kapasitas', $ruangan->kapasitas) }}" min="1" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('kapasitas') border-red-500 @enderror" 
                required>
            @error('kapasitas')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Ruangan</label>
            @if($ruangan->foto)
                <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="{{ $ruangan->nama }}" class="mb-2 w-32 h-32 object-cover rounded border-4 border-amber-600">
            @endif
            <input type="file" name="foto" accept="image/*" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('foto') border-red-500 @enderror">
            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah foto</p>
            @error('foto')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
            <select name="status" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('status') border-red-500 @enderror" 
                required>
                <option value="tersedia" {{ old('status', $ruangan->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                <option value="tidak_tersedia" {{ old('status', $ruangan->status) == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300">
                Update
            </button>
            <a href="{{ route('ruangans.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection