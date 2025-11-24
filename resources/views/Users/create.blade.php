@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="text-3xl font-bold text-white drop-shadow-lg">Tambah User</h1>
    @if(auth()->user()->foto)
        <div class="flex items-center gap-3 bg-white/20 backdrop-blur-md px-4 py-2 rounded-2xl shadow-lg border border-white/30">
            <img src="{{ asset('storage/' . auth()->user()->foto) }}" 
                 class="w-14 h-14 rounded-full object-cover border-4 border-amber-500">
            <div class="text-white">
                <p class="font-bold">{{ auth()->user()->name }}</p>
                <p class="text-sm opacity-80">Sedang Login</p>
            </div>
        </div>
    @else
        <div class="flex items-center gap-3 bg-white/20 backdrop-blur-md px-4 py-2 rounded-2xl shadow-lg border border-white/30">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=F59E0B&color=fff" 
                 class="w-14 h-14 rounded-full object-cover border-4 border-amber-500">
            <div class="text-white">
                <p class="font-bold">{{ auth()->user()->name }}</p>
                <p class="text-sm opacity-80">Sedang Login</p>
            </div>
        </div>
    @endif
</div>

<div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 max-w-2xl border-4 border-amber-600">
<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
@csrf

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
        <input type="text" name="name" value="{{ old('name') }}" 
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('name') border-red-500 @enderror" 
            required>
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" 
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('email') border-red-500 @enderror" 
            required>
        @error('email')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
        <input type="password" name="password" 
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('password') border-red-500 @enderror" 
            required>
        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
        <select name="role_id" 
            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('role_id') border-red-500 @enderror" 
            required>
            <option value="">Pilih Role</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
        @error('role_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2">
            Foto Profil 
            <span class="text-gray-500 font-normal">(Opsional - Khusus Admin & Petugas)</span>
        </label>
        <div class="flex items-center space-x-4">
            <div class="flex-1">
                <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png" 
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('foto') border-red-500 @enderror"
                    onchange="previewImage(event)">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB</p>
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div id="imagePreview" class="hidden">
                <img id="preview" src="" alt="Preview" class="w-20 h-20 rounded-full object-cover border-4 border-amber-600 shadow-lg">
            </div>
        </div>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg border-2 border-amber-400 transition duration-300 transform hover:scale-105">
            Simpan
        </button>
        <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300">
            Batal
        </a>
    </div>
</form></div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('imagePreview').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
