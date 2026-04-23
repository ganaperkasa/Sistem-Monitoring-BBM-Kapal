@extends('layouts.app')
@section('content')
    <div class="container-fluid px-2" style="overflow-x: hidden;">

        <div class="card shadow">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <h5 class="mb-2 mb-md-0">Detail Data Operasional</h5>

                <a href="{{ route('operasional.pdf', $data->id) }}" class="btn btn-danger">
                    <i class="bi bi-file-earmark-pdf"></i> PDF
                </a>
            </div>

            <div class="card-body" style="word-wrap: break-word;">

                {{-- ================= INFO KAPAL ================= --}}
                <h6 class="mb-3">Informasi Kapal</h6>
                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6 col-12 mb-2">
                        <strong>Jenis Kapal</strong><br>
                        {{ $data->jenis_kapal }}
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-2">
                        <strong>Tahun Kapal</strong><br>
                        {{ $data->tahun_kapal }}
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-2">
                        <strong>Kapasitas Kapal (GT)</strong><br>
                        {{ $data->kapasitas_kapal }}
                    </div>
                </div>

                {{-- ================= OPERASIONAL ================= --}}
                <h6 class="mb-3">Data Operasional</h6>
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-4 col-6 mb-2">
                        <strong>Kecepatan Kapal (Rpm)</strong><br>
                        {{ $data->rpm }}
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 mb-2">
                        <strong>Daya Mesin (kW)</strong><br>
                        {{ $data->daya_mesin }}
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 mb-2">
                        <strong>Lama Operasi (jam)</strong><br>
                        {{ $data->lama_operasi }}
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 mb-2">
                        <strong>Jarak Tempuh (NM)</strong><br>
                        {{ $data->jarak_tempuh }}
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 mb-2">
                        <strong>Konsumsi BBM (Ton)</strong><br>
                        {{ $data->konsumsi_bbm }}
                    </div>
                    <div class="col-lg-3 col-md-4 col-6 mb-2">
                        <strong>Jenis BBM</strong><br>
                        {{ $data->bbm->jenis_bbm ?? '-' }}
                    </div>
                </div>

                {{-- ================= HASIL EMISI ================= --}}
                <h6 class="mb-3">Hasil Emisi</h6>
                <div class="row text-center mb-4 g-2">

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>CO₂</h6>
                                <h5>{{ $data->co2 }} g/kWh</h5>
                                <span class="badge bg-{{ $co2_color }}">{{ $co2_status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>NOx</h6>
                                <h5>{{ $data->nox }} g/kWh</h5>
                                <span class="badge bg-{{ $nox_color }}">{{ $nox_status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>SOx</h6>
                                <h5>{{ $data->sox }} % sulfur</h5>
                                <span class="badge bg-{{ $sox_color }}">{{ $sox_status }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h6>CII</h6>
                                <h5>{{ $data->cii }} gCO₂/ton·NM</h5>
                                <span class="badge bg-{{ $cii_color }}">{{ $cii_status }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ================= REKOMENDASI ================= --}}
                <h6 class="mb-3">Rekomendasi</h6>
                <div class="card bg-light border-0 mb-4">
                    <div class="card-body">
                        <ul>
                            <li>
                                <strong>CO₂:</strong><br>
                                @if ($co2_color == 'success')
                                    Emisi rendah, pertahankan operasional.
                                @elseif($co2_color == 'warning')
                                    Perlu efisiensi bahan bakar.
                                @else
                                    Perlu evaluasi konsumsi dan rute.
                                @endif
                            </li>

                            <li>
                                <strong>NOx:</strong><br>
                                @if ($nox_color == 'success')
                                    Mesin optimal sesuai IMO.
                                @elseif($nox_color == 'warning')
                                    Perlu monitoring berkala.
                                @else
                                    Perlu perawatan atau SCR.
                                @endif
                            </li>

                            <li>
                                <strong>SOx:</strong><br>
                                @if ($sox_color == 'success')
                                    Sesuai MARPOL Annex VI.
                                @elseif($sox_color == 'warning')
                                    Masih batas aman global.
                                @else
                                    Gunakan BBM rendah sulfur.
                                @endif
                            </li>

                            <li>
                                <strong>CII:</strong><br>
                                @if ($cii_color == 'success')
                                    Sangat efisien.
                                @elseif($cii_color == 'info')
                                    Efisien.
                                @elseif($cii_color == 'warning')
                                    Perlu peningkatan.
                                @else
                                    Perlu evaluasi total.
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- ================= KESIMPULAN ================= --}}
                <div class="alert alert-info">
                    <strong>Kesimpulan Akhir:</strong><br>
                    Sistem menunjukkan bahwa kondisi emisi kapal saat ini
                    <strong>{{ $overall }}</strong>.
                </div>

            </div>
        </div>

    </div>
@endsection
