<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Operasional;
use App\Models\Emisi;
use Yajra\DataTables\Facades\DataTables;
use App\Models\JenisBBM;

class KonsumsiBBMController extends Controller
{
    public function index()
    {
        return view('bbm/index');
    }
    public function create()
    {
        $bbm = JenisBBM::all();
        return view('bbm.create', compact('bbm'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kapal' => 'required',
            'tahun_kapal' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'kapasitas_kapal' => 'required|numeric|min:1',
            'rpm' => 'required|numeric',
            'daya_mesin' => 'required|numeric',
            'lama_operasi' => 'required|numeric',
            'jarak_tempuh' => 'required|numeric',
            'konsumsi_bbm' => 'required|numeric',
            'jenis_bbm_id' => 'required',
        ]);

        $bbm = JenisBBM::find($request->jenis_bbm_id);

        $tier = $this->getTier($request->tahun_kapal, false);
        $co2 = $request->konsumsi_bbm * $bbm->faktor_emisi;
        $sox = 2 * $bbm->sulfur * $request->konsumsi_bbm;

        $rpm = $request->rpm;
        if ($tier == 'Tier I') {
            $k = 45;
        } elseif ($tier == 'Tier II') {
            $k = 44;
        } else {
            $k = 43;
        }

        if ($rpm < 130) {
            $ef_nox = 17;
        } elseif ($rpm <= 2000) {
            $ef_nox = $k * pow($rpm, -0.23);
        } else {
            $ef_nox = 9.8;
        }

        $nox = ($ef_nox * $request->daya_mesin * $request->lama_operasi) / 1000;
        $cii = $co2 / ($request->jarak_tempuh * $request->kapasitas_kapal);

        Operasional::create([
            'jenis_kapal' => $request->jenis_kapal,
            'tahun_kapal' => $request->tahun_kapal,
            'kapasitas_kapal' => $request->kapasitas_kapal,
            'area' => $request->area,
            'tier' => $tier,
            'rpm' => $request->rpm,
            'daya_mesin' => $request->daya_mesin,
            'lama_operasi' => $request->lama_operasi,
            'jarak_tempuh' => $request->jarak_tempuh,
            'konsumsi_bbm' => $request->konsumsi_bbm,
            'jenis_bbm_id' => $request->jenis_bbm_id,

            'co2' => $co2,
            'sox' => $sox,
            'nox' => $nox,
            'cii' => $cii,
        ]);

        return back()->with('success', 'Data berhasil disimpan & dihitung');
    }
    function getTier($tahun, $isECA = false)
    {
        if ($tahun < 2011) {
            return 'Tier I';
        } elseif ($tahun >= 2011 && $tahun < 2016) {
            return 'Tier II';
        } else {
            return $isECA ? 'Tier III' : 'Tier II';
        }
    }

    public function data()
    {
        if (Auth::user()->role == 'admin') {
            $query = Operasional::with('bbm')->select('operationals.*');
        } else {
            $query = Operasional::with('bbm')->where('user_id', Auth::id())->select('operationals.*');
        }

        return DataTables::of($query)

            ->addColumn('aksi', function ($row) {
                return '<button>Edit</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
