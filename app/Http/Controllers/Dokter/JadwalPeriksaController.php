<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwalPeriksas = JadwalPeriksa::with('dokter')
            ->where('id_dokter', Auth::id())
            ->get();
    
        return view('dokter.jadwal_periksa.index', compact('jadwalPeriksas'));
    }

    public function create()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('dokter.jadwal_periksa.create', compact('dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => false,
        ]);

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
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'status' => 'required|boolean',
        ]);

        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        if ($request->status) {
            JadwalPeriksa::where('id_dokter', Auth::id())
                ->where('id', '!=', $id)
                ->where('status', true)
                ->update(['status' => false]);
        }

        $jadwalPeriksa->update([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => $request->status,
        ]);

        return redirect()->route('dokter.jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil diperbarui.');
    }

    public function toggleStatus($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);

        if (!$jadwalPeriksa->status) {
            $dokterId = $jadwalPeriksa->id_dokter;
            JadwalPeriksa::where('id_dokter', $dokterId)
                ->where('status', true)
                ->update(['status' => false]);
        }

        $jadwalPeriksa->status = !$jadwalPeriksa->status;
        $jadwalPeriksa->save();

        return redirect()->route('dokter.jadwal_periksa.index')->with('success', 'Status jadwal berhasil diubah.');
    }

    public function destroy($id)
    {
        $jadwalPeriksa = JadwalPeriksa::findOrFail($id);
        $jadwalPeriksa->delete();

        return redirect()->route('dokter.jadwal_periksa.index')->with('success', 'Jadwal periksa berhasil dihapus.');
    }
}