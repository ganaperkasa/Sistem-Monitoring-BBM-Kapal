<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Operasional;
use App\Models\Emisi;
use Yajra\DataTables\Facades\DataTables;

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

        $co2 = $request->konsumsi_bbm * 2.68;
        $efisiensi = $request->jarak_tempuh / $request->konsumsi_bbm;

        Emisi::create([
            'operasional_id' => $operasional->id,
            'co2' => $co2,
            'nox' => 0,
            'so2' => 0,
            'efisiensi' => $efisiensi,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan');
    }

    public function data()
    {
        $query = Operasional::with('emisi')->select('operasionals.*');

        return DataTables::of($query)
            ->addColumn('co2', function ($row) {
                return optional($row->emisi)->co2 ?? '-';
            })
            ->addColumn('efisiensi', function ($row) {
                return optional($row->emisi)->efisiensi ?? '-';
            })
            ->addColumn('aksi', function ($row) {
                return '<button>Edit</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
