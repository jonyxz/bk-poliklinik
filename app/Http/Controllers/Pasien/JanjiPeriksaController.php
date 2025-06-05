<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\JanjiPeriksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JanjiPeriksaController extends Controller
{
    public function index()
    {
        $janjiPeriksas = JanjiPeriksa::with('pasien')
            ->where('id_pasien', Auth::id())
            ->get();
        $dokters = User::with([
            'jadwalPeriksas' => function ($query) {
                $query->where('status', true);
            },
        ])
        ->where('role', 'dokter')
        ->get();
        $no_rm = Auth::user()->no_rm;
        return view('pasien.janji_periksa.index', compact('janjiPeriksas'))->with([
            'no_rm' => $no_rm,
            'dokters' => $dokters,
        ]);
    }

    public function create()
    {
        $pasiens = User::where('role', 'pasien')->get();
        return view('pasien.janji_periksa.create', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required|string|max:255',
            'no_antrian' => 'nullable|integer',
        ]);

        JanjiPeriksa::create([
            'id_pasien' => Auth::id(),
            'keluhan' => $request->keluhan,
            'no_antrian' => $request->no_antrian,
        ]);

        return redirect()->route('pasien.janji_periksa.index')->with('success', 'Janji periksa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $pasiens = User::where('role', 'pasien')->get();
        return view('pasien.janji_periksa.edit', compact('janjiPeriksa', 'pasiens'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keluhan' => 'required|string|max:255',
            'no_antrian' => 'nullable|integer',
        ]);

        $janjiPeriksa = JanjiPeriksa::findOrFail($id);

        $janjiPeriksa->update([
            'id_pasien' => Auth::id(),
            'keluhan' => $request->keluhan,
            'no_antrian' => $request->no_antrian,
        ]);

        return redirect()->route('pasien.janji_periksa.index')->with('success', 'Janji periksa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $janjiPeriksa = JanjiPeriksa::findOrFail($id);
        $janjiPeriksa->delete();

        return redirect()->route('pasien.janji_periksa.index')->with('success', 'Janji periksa berhasil dihapus.');
    }
}