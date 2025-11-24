<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Reservasi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $data = [
            'totalRuangan' => Ruangan::count(),
            'totalReservasi' => 0,
            'reservasiPending' => 0,
            'reservasiDisetujui' => 0,
        ];

        if ($user->isKaryawan()) {
            $data['totalReservasi'] = Reservasi::where('user_id', $user->id)->count();
            $data['reservasiPending'] = Reservasi::where('user_id', $user->id)->where('status', 'pending')->count();
            $data['reservasiDisetujui'] = Reservasi::where('user_id', $user->id)->where('status', 'disetujui')->count();
        } else {
            $data['totalReservasi'] = Reservasi::count();
            $data['reservasiPending'] = Reservasi::where('status', 'pending')->count();
            $data['reservasiDisetujui'] = Reservasi::where('status', 'disetujui')->count();
            $data['totalUser'] = User::count();
        }

        return view('dashboard', $data);
    }
}