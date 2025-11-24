@extends('layouts.app')

@section('title', 'Buat Reservasi')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Buat Reservasi</h1>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('reservasis.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Ruangan</label>
            <select name="ruangan_id" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('ruangan_id') border-red-500 @enderror" 
                required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}" {{ old('ruangan_id') == $ruangan->id ? 'selected' : '' }}>
                        {{ $ruangan->nama }} (Kapasitas: {{ $ruangan->kapasitas }} orang)
                    </option>
                @endforeach
            </select>
            @error('ruangan_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Mulai</label>
            <input type="datetime-local" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_mulai') border-red-500 @enderror" 
                required>
            @error('tanggal_mulai')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Selesai</label>
            <input type="datetime-local" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal_selesai') border-red-500 @enderror" 
                required>
            @error('tanggal_selesai')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Keperluan</label>
            <textarea name="keperluan" rows="4" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('keperluan') border-red-500 @enderror" 
                required>{{ old('keperluan') }}</textarea>
            @error('keperluan')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Buat Reservasi
            </button>
            <a href="{{ route('reservasis.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection