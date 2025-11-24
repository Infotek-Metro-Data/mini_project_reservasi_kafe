<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::all();
        return view('ruangans.index', compact('ruangans'));
    }

    public function create()
    {
        return view('ruangans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:interior,rooftop,meeting_room',
            'deskripsi' => 'required|string',
            'kapasitas' => 'required|integer|min:1',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:tersedia,tidak_tersedia'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('ruangan', $filename, 'public');
            $data['foto'] = $path;
        }

        Ruangan::create($data);

        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangans.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:interior,rooftop,meeting_room',
            'deskripsi' => 'required|string',
            'kapasitas' => 'required|integer|min:1',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:tersedia,tidak_tersedia'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($ruangan->foto) {
                Storage::disk('public')->delete($ruangan->foto);
            }

            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('ruangan', $filename, 'public');
            $data['foto'] = $path;
        }

        $ruangan->update($data);

        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil diupdate');
    }

    public function destroy(Ruangan $ruangan)
    {
        if ($ruangan->foto) {
            Storage::disk('public')->delete($ruangan->foto);
        }

        $ruangan->delete();
        return redirect()->route('ruangans.index')->with('success', 'Ruangan berhasil dihapus');
    }
}