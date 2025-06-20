<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'desc');

        $obats = Obat::query()
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_obat', 'like', "%{$search}%")
                    ->orWhere('kemasan', 'like', "%{$search}%");
                });
            })
            ->orderBy($sortBy, $sortOrder)
            ->get();

        return view('dokter.obat.index', compact('obats', 'search', 'sortBy', 'sortOrder'));
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function edit($id)
    {
        $obat = Obat::find($id);
        return view('dokter.obat.edit')->with([
            'obat' => $obat,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga'    => 'required|numeric|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan'   => 'required|string|max:255',
            'harga'     => 'required|numeric|min:0',
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan'   => $request->kemasan,
            'harga'     => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-updated');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('dokter.obat.index')->with('status', 'obat-deleted');
    }

    public function trash()
    {
        $obats = Obat::onlyTrashed()->get();
        return view('dokter.obat.trash', compact('obats'));
    }
    public function restore($id)
    {
        $obat = Obat::onlyTrashed()->findOrFail($id);
        $obat->restore();

        return redirect()->route('dokter.obat.index')->with('status', 'obat-restored');
    }

    public function forceDelete($id)
    {
        $obat = Obat::onlyTrashed()->findOrFail($id);
        $obat->forceDelete();
        return redirect()->route('dokter.obat.trash')->with('status', 'obat-deleted-permanently');
    }
}
