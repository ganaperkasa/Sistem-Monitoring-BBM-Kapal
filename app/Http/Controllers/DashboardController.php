<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operasional;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\JenisBBM;

class DashboardController extends Controller
{
    public function index()
    {
       $userId = Auth::id();

    $data = Operasional::where('user_id', $userId);
    $chart = Operasional::where('user_id', Auth::id())
    ->orderBy('created_at', 'asc')
    ->get();

    return view('dashboard', [
        'total_co2' => $data->sum('co2'),
        'total_nox' => $data->sum('nox'),
        'total_sox' => $data->sum('sox'),
        'avg_cii'   => $data->avg('cii'),
        'chart' => $chart,

        'recent' => $data->latest()->take(5)->get()
    ]);
    }
}
