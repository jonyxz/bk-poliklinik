<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::with('dokter')->get();
        return view('dokter.jadwal_periksa.index', compact('jadwalPeriksas'));
    }

    public function create()
    {
        $dokters = User::where('role', 'dokter')->get(); // Asumsi ada kolom 'role' di tabel users
        return view('dokter.jadwal_periksa.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|boolean',
        ]);

        JadwalPeriksa::create($request->all());

        return redirect()->route('dokter.jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $dokters = User::where('role', 'dokter')->get();
        return view('dokter.jadwal_periksa.edit', compact('jadwalPeriksa', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_dokter' => 'required|exists:users,id',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|boolean',
        ]);

        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->update($request->all());

        return redirect()->route('dokter.jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->delete();

        return redirect()->route('dokter.jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil dihapus.');
    }
}