@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                <span class="bg-purple-600 w-2 h-8 rounded-full mr-3"></span>
                Manajemen User
            </h1>
            <p class="text-gray-500 mt-1 ml-5">Kelola data pengguna, role, dan akses sistem</p>
        </div>
        
        <a href="{{ route('users.create') }}" class="group bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1 flex items-center">
            <svg class="w-5 h-5 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah User
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-purple-100">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Foto</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold uppercase tracking-wider">Role</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-purple-50 transition duration-200">                   
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex-shrink-0 h-12 w-12">
                                @if($user->foto)
                                    <img class="h-12 w-12 rounded-full object-cover border-2 border-purple-200 shadow-sm" 
                                         src="{{ asset('storage/foto/'.$user->foto) }}" 
                                         alt="{{ $user->name }}">
                                @else
                         
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-purple-100 to-indigo-200 flex items-center justify-center border-2 border-purple-200 shadow-sm text-purple-700 font-bold tracking-wider">

                                        {{ strtoupper(collect(explode(' ', $user->name))->map(function($segment){ return substr($segment, 0, 1); })->take(2)->join('')) }}
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-900">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">Bergabung: {{ $user->created_at->format('d M Y') }}</div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                @if($user->role->name == 'admin') bg-purple-100 text-purple-800 border border-purple-200
                                @elseif($user->role->name == 'petugas') bg-amber-100 text-amber-800 border border-amber-200
                                @else bg-green-100 text-green-800 border border-green-200
                                @endif">
                                {{ ucfirst($user->role->name) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1 rounded-lg transition duration-200">
                                    Edit
                                </a>
                                
                                @if($user->id !== auth()->id())
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-lg transition duration-200" 
                                            onclick="return confirm('Yakin ingin menghapus user {{ $user->name }}?')">
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(isset($users) && method_exists($users, 'links'))
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection