<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JanjiPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;

class PeriksaController extends Controller
{
    public function index()
    {
        $dokterId = Auth::user()->id;
        $janjiPeriksas = JanjiPeriksa::with(['jadwalPeriksa', 'pasien'])
            ->whereHas('jadwalPeriksa', function ($q) use ($dokterId) {
                $q->where('id_dokter', $dokterId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return view('dokter.periksa.index', compact('janjiPeriksas'));
    }

    public function create($id)
    {
        $janji = JanjiPeriksa::with(['jadwalPeriksa', 'pasien'])->findOrFail($id);
        $obats = Obat::all();
        return view('dokter.periksa.create', compact('janji', 'obats'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'hasil' => 'required',
            'obat' => 'array',
            'obat.*' => 'integer|exists:obats,id',
        ]);

        $janji = JanjiPeriksa::findOrFail($id);

        $totalObat = 0;
        if ($request->has('obat')) {
            $obatList = Obat::whereIn('id', $request->obat)->get();
            $totalObat = $obatList->sum('harga');
        }

        $biayaPeriksa = 150000 + $totalObat;

        $periksa = Periksa::create([
            'id_janji_periksa' => $janji->id,
            'tgl_periksa' => now(),
            'catatan' => $request->hasil,
            'biaya_periksa' => $biayaPeriksa,
        ]);

        if ($request->has('obat')) {
            foreach ($request->obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat,
                ]);
            }
        }

        return redirect()->route('dokter.periksa.index')->with('status', 'periksa-selesai');
    }
}
