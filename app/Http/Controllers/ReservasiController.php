<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isKaryawan()) {
            $reservasis = Reservasi::with(['ruangan', 'user'])
                ->where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $reservasis = Reservasi::with(['ruangan', 'user', 'verifiedBy'])
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('reservasis.index', compact('reservasis'));
    }

    public function create()
    {
        $ruangans = Ruangan::where('status', 'tersedia')->get();
        return view('reservasis.create', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruangan_id' => 'required|exists:ruangans,id',
            'tanggal_mulai' => 'required|date|after_or_equal:now',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'keperluan' => 'required|string'
        ], [
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai'
        ]);

        // Cek konflik reservasi yang sudah disetujui
        $conflict = Reservasi::where('ruangan_id', $request->ruangan_id)
            ->where('status', 'disetujui')
            ->where(function($query) use ($request) {
                $query->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhereBetween('tanggal_selesai', [$request->tanggal_mulai, $request->tanggal_selesai])
                    ->orWhere(function($q) use ($request) {
                        $q->where('tanggal_mulai', '<=', $request->tanggal_mulai)
                          ->where('tanggal_selesai', '>=', $request->tanggal_selesai);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Ruangan sudah direservasi pada waktu tersebut')->withInput();
        }

        Reservasi::create([
            'user_id' => auth()->id(),
            'ruangan_id' => $request->ruangan_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keperluan' => $request->keperluan,
            'status' => 'pending'
        ]);

        return redirect()->route('reservasis.index')->with('success', 'Reservasi berhasil dibuat');
    }

    public function verify(Request $request, Reservasi $reservasi)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan_petugas' => 'nullable|string'
        ]);

        $reservasi->update([
            'status' => $request->status,
            'catatan_petugas' => $request->catatan_petugas,
            'verified_by' => auth()->id()
        ]);

        return redirect()->route('reservasis.index')->with('success', 'Reservasi berhasil diverifikasi');
    }
}