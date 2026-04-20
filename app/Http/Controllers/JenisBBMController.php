<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisBBM;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class JenisBBMController extends Controller
{
    public function index()
    {
        // $jenisBBM = JenisBBM::all();
        return view('jenis_bbm.index');
    }

    public function create()
    {
        return view('jenis_bbm.create');
    }

    public function store(Request $request)
    {
        // ubah koma jadi titik
        $faktorEmisi = str_replace(',', '.', $request->faktor_emisi);
        $sulfur = str_replace(',', '.', $request->sulfur);

        $request->merge([
            'faktor_emisi' => $faktorEmisi,
            'sulfur' => $sulfur,
        ]);

        $request->validate([
            'jenis_bbm' => 'required',
            'faktor_emisi' => ['required', 'regex:/^[0-9.,]+$/'],
            'sulfur' => ['required', 'regex:/^[0-9.,]+$/'],
        ]);

        \App\Models\JenisBbm::create($request->all());

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function data()
    {
        $query = JenisBBM::select('jenis_bbms.*');
        return DataTables::of($query)
            ->addColumn('aksi', function ($row) {
                return '<button>Edit</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
