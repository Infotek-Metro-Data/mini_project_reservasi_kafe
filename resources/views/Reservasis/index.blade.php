@extends('layouts.app')

@section('title', 'Riwayat Reservasi')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">Riwayat Reservasi</h1>
    @if(auth()->user()->isKaryawan())
    <a href="{{ route('reservasis.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
        Buat Reservasi
    </a>
    @endif
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                @if(!auth()->user()->isKaryawan())
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon</th>
                @endif
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                <th class="px-6 py-3 text-left text -xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($reservasis as $reservasi)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="font-medium text-gray-900">{{ $reservasi->ruangan->nama }}</div>
                    <div class="text-sm text-gray-500">{{ $reservasi->keperluan }}</div>
                </td>
                @if(!auth()->user()->isKaryawan())
                <td class="px-6 py-4 whitespace-nowrap">{{ $reservasi->user->name }}</td>
                @endif
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $reservasi->tanggal_mulai->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    {{ $reservasi->tanggal_selesai->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($reservasi->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($reservasi->status == 'disetujui') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($reservasi->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    @if($reservasi->status == 'pending' && (auth()->user()->isAdmin() || auth()->user()->isPetugas()))
                    <button onclick="openModal({{ $reservasi->id }})" class="text-blue-600 hover:text-blue-900">
                        Verifikasi
                    </button>
                    @elseif($reservasi->catatan_petugas)
                    <button onclick="showNote('{{ $reservasi->catatan_petugas }}')" class="text-gray-600 hover:text-gray-900">
                        Lihat Catatan
                    </button>
                    @else
                    -
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data reservasi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

>
<div id="verifikasiModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Verifikasi Reservasi</h3>
            <form id="verifikasiForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="disetujui">Disetujui</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Catatan</label>
                    <textarea name="catatan_petugas" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Simpan
                    </button>
                    <button type="button" onclick="closeModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="noteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Catatan Petugas</h3>
            <p id="noteContent" class="text-gray-700 mb-4"></p>
            <button onclick="closeNoteModal()" class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById('verifikasiForm').action = '/reservasis/' + id + '/verify';
    document.getElementById('verifikasiModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('verifikasiModal').classList.add('hidden');
}

function showNote(note) {
    document.getElementById('noteContent').textContent = note;
    document.getElementById('noteModal').classList.remove('hidden');
}

function closeNoteModal() {
    document.getElementById('noteModal').classList.add('hidden');
}
</script>
@endsection