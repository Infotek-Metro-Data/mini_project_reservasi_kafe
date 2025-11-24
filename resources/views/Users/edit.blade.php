@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-white drop-shadow-lg">Edit User</h1>
</div>

<div class="bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl p-8 max-w-2xl border-4 border-amber-600">
    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('name') border-red-500 @enderror" 
                required>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('email') border-red-500 @enderror" 
                required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" name="password" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Role</label>
            <select name="role_id" 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('role_id') border-red-500 @enderror" 
                required>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
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
                <span class="text-gray-500 font-normal">(Opsional)</span>
            </label>
            
            @if($user->foto)
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-2">Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->name }}" class="w-24 h-24 rounded-full object-cover border-4 border-amber-600 shadow-lg">
                </div>
            @endif

            <div class="flex items-center space-x-4">
                <div class="flex-1">
                    <input type="file" name="foto" accept="image/jpeg,image/jpg,image/png" 
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-amber-500 @error('foto') border-red-500 @enderror"
                        onchange="previewImage(event)">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto</p>
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
                Update
            </button>
            <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded-lg shadow-lg transition duration-300">
                Batal
            </a>
        </div>
    </form>
</div>

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
{{-- FOTO PROFIL --}}
<div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2">
        Foto Profil
    </label>

    <input type="file" name="foto" accept="image/jpeg,image/png" 
           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-500 focus:outline-none">
    <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG — Maksimal 2MB</p>
</div>

@if(isset($user) && $user->foto)
<div class="mt-2">
    <img src="{{ asset('storage/foto/'.$user->foto) }}" 
         class="w-24 h-24 rounded-full object-cover border-2 border-amber-600 shadow-lg">
</div>
@endif

}
</script>
@endsection