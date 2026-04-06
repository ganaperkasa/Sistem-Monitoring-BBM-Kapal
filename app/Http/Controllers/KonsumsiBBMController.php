<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Operasional;
use App\Models\Emisi;

class KonsumsiBBMController extends Controller
{
    public function index()
    {
        return view('bbm/index');
    }
    public function create()
    {
        return view('bbm/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kapal' => 'required',
            'tanggal' => 'required|date',
            'lama_operasi' => 'required|numeric',
            'jarak_tempuh' => 'required|numeric',
            'konsumsi_bbm' => 'required|numeric',
        ]);

        $operasional = Operasional::create($request->all());

        // 🔥 Perhitungan sesuai konsep IMO (sederhana)
        $co2 = $request->konsumsi_bbm * 2.68;
        $efisiensi = $request->jarak_tempuh / $request->konsumsi_bbm;

        Emisi::create([
            'operasional_id' => $operasional->id,
            'co2' => $co2,
            'nox' => 0,
            'so2' => 0,
            'efisiensi' => $efisiensi
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }


}
