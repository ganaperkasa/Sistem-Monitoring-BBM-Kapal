<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Operasional;
use App\Models\Emisi;
use Yajra\DataTables\Facades\DataTables;

use App\Models\JenisBBM;
use App\Models\User;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class KonsumsiBBMController extends Controller
{
    public function index()
    {
        // dd(Auth::id());

        return view('bbm/index');
    }

    public function history()
    {
        $userId = Auth::id();

        $data = Operasional::where('user_id', $userId);
        $chart = Operasional::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();

        return view('bbm/history', [
            'total_co2' => $data->sum('co2'),
            'total_nox' => $data->sum('nox'),
            'total_sox' => $data->sum('sox'),
            'avg_cii' => $data->avg('cii'),
            'chart' => $chart,

            'recent' => $data->latest()->take(5)->get(),
        ]);
    }
    public function create()
    {
        $bbm = JenisBBM::all();
        return view('bbm.create', compact('bbm'));
    }

    public function store(Request $request)
    {
        $request->merge([
    'rpm' => str_replace(',', '.', $request->rpm),
]);
        $request->validate(
            [
                'jenis_kapal' => 'required',
                'tahun_kapal' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
                'kapasitas_kapal' => 'required|numeric|min:1',
                'rpm' => ['required','numeric','regex:/^\d+(\.\d{1,3})?$/'],
                'daya_mesin' => 'required|numeric',
                'jarak_tempuh' => 'required|numeric',
                'konsumsi_bbm' => 'required|numeric',
                'jenis_bbm_id' => 'required',
                'rpm2' => 'required|numeric',
            ],
            [
                'jenis_kapal.required' => 'Jenis kapal wajib diisi',
                'tahun_kapal.required' => 'Tahun kapal wajib diisi',
                'tahun_kapal.digits' => 'Tahun kapal harus berupa 4 digit',
                'tahun_kapal.integer' => 'Tahun kapal harus berupa angka',
                'tahun_kapal.min' => 'Tahun kapal tidak valid',
                'tahun_kapal.max' => 'Tahun kapal tidak valid',
                'kapasitas_kapal.required' => 'Kapasitas kapal wajib diisi',
                'kapasitas_kapal.numeric' => 'Kapasitas kapal harus berupa angka',
                'kapasitas_kapal.min' => 'Kapasitas kapal minimal 1 GT',
                'rpm.required' => 'RPM wajib diisi',
                'rpm.numeric' => 'RPM harus berupa angka',
                'rpm.regex' => 'RPM maksimal 3 angka di belakang koma',
                'rpm2.required' => 'RPM wajib diisi',
                'rpm2.numeric' => 'RPM harus berupa angka',
                'daya_mesin.required' => 'Daya mesin wajib diisi',
                'daya_mesin.numeric' => 'Daya mesin harus berupa angka',
                'jarak_tempuh.required' => 'Jarak tempuh wajib diisi',
                'jarak_tempuh.numeric' => 'Jarak tempuh harus berupa angka',
                'jenis_bbm_id.required' => 'Jenis BBM wajib dipilih',
            ],
        );

        $lama_operasi = round($this->hitungLamaOperasi($request->jarak_tempuh, $request->rpm), 3);
        $konsumsi_bbm = round($this->hitungKonsumsiBBM($request->daya_mesin, $lama_operasi), 3);
        $konsumsi_bbm_ton = $konsumsi_bbm / 1000; // liter ke ton
        $bbm = JenisBBM::find($request->jenis_bbm_id);

        $tier = $this->getTier($request->tahun_kapal, false);
        $co2 = ($konsumsi_bbm / 1000) * $bbm->faktor_emisi; // liter ke kg ke ton ///satuan co2 = ton
        // $sox = 2 * $bbm->sulfur * $konsumsi_bbm;
        $sox1 = ($konsumsi_bbm * 1000) / ($request->daya_mesin * $lama_operasi);
        $sox = $sox1 * $bbm->sulfur * 1.955;

        $rpm2 = $request->rpm2;

        if ($tier == 'Tier I') {
            if ($rpm2 < 130) {
                $ef_nox = 17;
            } elseif ($rpm2 < 2000) {
                $ef_nox = 45 * pow($rpm2, -0.2);
            } else {
                $ef_nox = 9.8;
            }
        } elseif ($tier == 'Tier II') {
            if ($rpm2 < 130) {
                $ef_nox = 14.4;
            } elseif ($rpm2 < 2000) {
                $ef_nox = 44 * pow($rpm2, -0.23);
            } else {
                $ef_nox = 7.7;
            }
        } else {

            if ($rpm2 < 130) {
                $ef_nox = 3.4;
            } elseif ($rpm2 < 2000) {
                $ef_nox = 9 * pow($rpm2, -0.2);
            } else {
                $ef_nox = 2.6;
            }
        }

        $nox = ($request->daya_mesin * $lama_operasi * $ef_nox) / 1000;
        // $dwt = $request->kapasitas_kapal * 1.5;
        $cii = round(($co2 * 1000) / ($request->jarak_tempuh * $request->kapasitas_kapal), 2);

        //cii = co2 * 1000 / (jarak tempuh * berat kapal)

        Operasional::create([
            'user_id' => auth()->id(),
            'jenis_kapal' => $request->jenis_kapal,
            'tahun_kapal' => $request->tahun_kapal,
            'kapasitas_kapal' => $request->kapasitas_kapal,
            'area' => $request->area,
            'tier' => $tier,
            'rpm2' => $request->rpm2,
            'rpm' => str_replace(',', '.', $request->rpm),
            'daya_mesin' => $request->daya_mesin,
            'lama_operasi' => $lama_operasi,
            'jarak_tempuh' => $request->jarak_tempuh,
            'konsumsi_bbm' => $konsumsi_bbm,
            'jenis_bbm_id' => $request->jenis_bbm_id,

            'co2' => $co2,
            'sox' => $sox,
            'nox' => $nox,
            'cii' => $cii,
        ]);

        return redirect()->route('dashboard.create')->with('success', 'Data berhasil disimpan & dihitung');
    }
    function getTier($tahun, $isECA = false)
    {
        if ($tahun < 2000) {
            return 'Tier I';
        } elseif ($tahun >= 2000 && $tahun < 2016) {
            return 'Tier II';
        } else {
            return $isECA ? 'Tier III' : 'Tier II';
        }
    }

    private function hitungLamaOperasi($jarak_tempuh, $rpm)
    {
        if ($rpm > 0) {
            return $jarak_tempuh / $rpm;
        }

        return 0;
    }

    private function hitungKonsumsiBBM($daya_mesin, $lama_operasi)
    {
        if ($daya_mesin > 0 && $lama_operasi > 0) {
            return $daya_mesin * $lama_operasi * 0.232;
        }

        return 0;
    }
    public function show($id)
    {
        if (Auth::user()->role_id == 1) {
            $data = Operasional::with('bbm')->findOrFail($id);
        } else {
            $data = Operasional::with('bbm')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        }

        $co2_ton = $data->co2 / 1000;
        $nox_ton = $data->nox / 1000;
        $sox = $data->sox;
        $bbm = JenisBBM::find($data->jenis_bbm_id);
        $sulfur = $bbm->sulfur;

        if ($co2_ton < 50) {
            $co2_status = 'Rendah';
            $co2_color = 'success';
        } elseif ($co2_ton <= 150) {
            $co2_status = 'Sedang';
            $co2_color = 'warning';
        } else {
            $co2_status = 'Tinggi';
            $co2_color = 'danger';
        }
        if ($nox_ton <= 3.4) {
            $nox_status = 'Sangat Baik';
            $nox_color = 'success';
        } elseif ($nox_ton <= 14.4) {
            $nox_status = 'Normal';
            $nox_color = 'warning';
        } else {
            $nox_status = 'Tinggi';
            $nox_color = 'danger';
        }
        if ($sox <= 2.35) {
            $sox_status = 'Sesuai IMO';
            $sox_color = 'success';
        } else {
            $sox_status = 'Belum Sesuai';
            $sox_color = 'danger';
        }
        if ($data->cii < 5) {
            $cii_status = 'A - Sangat Efisien';
            $cii_color = 'success';
        } elseif ($data->cii < 8) {
            $cii_status = 'B - Efisien';
            $cii_color = 'info';
        } elseif ($data->cii < 12) {
            $cii_status = 'C - Cukup';
            $cii_color = 'warning';
        } elseif ($data->cii < 15) {
            $cii_status = 'D - Buruk';
            $cii_color = 'danger';
        } else {
            $cii_status = 'E - Sangat Buruk';
            $cii_color = 'dark';
        }

        $overall = $co2_color == 'success' && $nox_color == 'success' && $sox_color == 'success' && $cii_color == 'success' ? 'Kapal Ramah Lingkungan' : 'Perlu Evaluasi Operasional';

        return view('bbm.show', compact('data', 'co2_status', 'co2_color', 'nox_status', 'nox_color', 'sox_status', 'sox_color', 'cii_status', 'cii_color', 'overall'));
    }

    public function cetakPdf($id)
    {
        if (Auth::user()->role_id == 1) {
            $data = Operasional::with('bbm')->findOrFail($id);
        } else {
            $data = Operasional::with('bbm')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        }

        $co2_ton = $data->co2 / 1000;
        $nox_ton = $data->nox / 1000;
        $sox = $data->sox ;
        $bbm = JenisBBM::find($data->jenis_bbm_id);
        $sulfur = $bbm->sulfur;

        if ($co2_ton < 50) {
            $co2_status = 'Rendah';
            $co2_color = 'success';
        } elseif ($co2_ton <= 150) {
            $co2_status = 'Sedang';
            $co2_color = 'warning';
        } else {
            $co2_status = 'Tinggi';
            $co2_color = 'danger';
        }
        if ($nox_ton <= 3.4) {
            $nox_status = 'Sangat Baik';
            $nox_color = 'success';
        } elseif ($nox_ton <= 14.4) {
            $nox_status = 'Normal';
            $nox_color = 'warning';
        } else {
            $nox_status = 'Tinggi';
            $nox_color = 'danger';
        }
        if ($sox <= 2.35) {
            $sox_status = 'Sesuai IMO';
            $sox_color = 'success';
        } else {
            $sox_status = 'Belum Sesuai';
            $sox_color = 'danger';
        }
        if ($data->cii < 5) {
            $cii_status = 'A - Sangat Efisien';
            $cii_color = 'success';
        } elseif ($data->cii < 8) {
            $cii_status = 'B - Efisien';
            $cii_color = 'info';
        } elseif ($data->cii < 12) {
            $cii_status = 'C - Cukup';
            $cii_color = 'warning';
        } elseif ($data->cii < 15) {
            $cii_status = 'D - Buruk';
            $cii_color = 'danger';
        } else {
            $cii_status = 'E - Sangat Buruk';
            $cii_color = 'dark';
        }
        $isECA = false;

        $tier = $this->getTier($data->tahun_kapal, $isECA);
        $tierData = [
            'Tier I' => 'CO2 ≤ 17.0 Ton, NOx ≤ 14.4 Ton, SOx ≤ 3.5% sulfur',
            'Tier II' => 'CO2 ≤ 16.0 Ton, NOx ≤ 9.7 Ton, SOx ≤ 0.5% sulfur',
            'Tier III' => 'CO2 ≤ 15.0 Ton, NOx ≤ 3.4 Ton, SOx ≤ 0.1% sulfur',
        ];

        $overall = $co2_color == 'success' && $nox_color == 'success' && $sox_color == 'success' && $cii_color == 'success' ? 'Kapal Ramah Lingkungan' : 'Perlu Evaluasi Operasional';

        $pdf = PDF::loadView('bbm.pdf', compact('data', 'co2_status', 'co2_color', 'nox_status', 'nox_color', 'sox_status', 'sox_color', 'cii_status', 'cii_color', 'overall', 'tier', 'tierData'));

        return $pdf->download('laporan-emisi.pdf');
    }

    public function data()
    {
        if (Auth::user()->role == 'admin') {
            $query = Operasional::with('bbm')->orderBy('created_at', 'desc')->select('operationals.*');
        } else {
            $query = Operasional::with('bbm')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->select('operationals.*');
        }

        return DataTables::of($query)

            ->addColumn('aksi', function ($row) {
                return '
                            <div class="d-flex">
                                <a href="' .
                    route('operasional.show', $row->id) .
                    ' " class="btn btn-sm btn-info me-1">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function dashboard()
    {
        $userId = Auth::id();

        $data = Operasional::where('user_id', $userId);
        $chart = Operasional::where('user_id', Auth::id())->orderBy('created_at', 'asc')->get();

        return view('dashboard', [
            'total_co2' => $data->sum('co2'),
            'total_nox' => $data->sum('nox'),
            'total_sox' => $data->sum('sox'),
            'avg_cii' => $data->avg('cii'),
            'chart' => $chart,

            'recent' => $data->latest()->take(5)->get(),
        ]);
    }
}

// <button class="btn btn-sm btn-danger btn-delete" data-id="' .
//         $row->id .
//         '">
//     <i class="bi bi-trash"></i>
// </button>
