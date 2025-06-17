<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use App\Models\User;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class JanjiPeriksaController extends Controller
{
    // public function index()
    // {
    //     $janjiPeriksas = JanjiPeriksa::with(['jadwalPeriksa.dokter', 'pasien'])
    //         ->where('id_pasien', Auth::id())
    //         ->get();
    //     $no_rm = Auth::user()->no_rm;

    //     return view('pasien.janji_periksa.index', compact('janjiPeriksas', 'no_rm'));
    // }

    public function create()
    {
        $jadwalPeriksas = JadwalPeriksa::with('dokter')
            ->where('status', true)
            ->get();
        $no_rm = Auth::user()->no_rm;
    
        return view('pasien.janji_periksa.create')->with([
            'no_rm' => $no_rm,
            'jadwalPeriksas' => $jadwalPeriksas,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required',
        ]);

        $jumlahJanji = JanjiPeriksa::where('id_jadwal_periksa', $validatedData['id_jadwal_periksa'])->count();
        $noAntrian = $jumlahJanji + 1;

        JanjiPeriksa::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal_periksa' => $validatedData['id_jadwal_periksa'],
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return Redirect::route('pasien.janji_periksa.create')->with('status', 'janji_periksa-created');
    }

    // public function edit($id)
    // {
    //     $janjiPeriksa = JanjiPeriksa::with('jadwalPeriksa.dokter')->findOrFail($id);
    //     $jadwalPeriksas = JadwalPeriksa::with('dokter')
    //         ->where('status', true)
    //         ->get();

    //     $no_rm = Auth::user()->no_rm;

    //     return view('pasien.janji_periksa.edit')->with([
    //         'janjiPeriksa' => $janjiPeriksa,
    //         'jadwalPeriksas' => $jadwalPeriksas,
    //         'no_rm' => $no_rm,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
    //         'keluhan' => 'required',
    //     ]);

    //     $janjiPeriksa = JanjiPeriksa::findOrFail($id);

    //     $janjiPeriksa->update([
    //         'id_jadwal_periksa' => $validatedData['id_jadwal_periksa'],
    //         'keluhan' => $validatedData['keluhan'],
    //     ]);

    //     return Redirect::route('pasien.janji_periksa.index')->with('status', 'janji_periksa-updated');
    // }

    // public function destroy($id)
    // {
    //     $janjiPeriksa = JanjiPeriksa::findOrFail($id);
    //     $janjiPeriksa->delete();

    //     return redirect()->route('pasien.janji_periksa.index')->with('success', 'Janji periksa berhasil dihapus.');
    // }
}