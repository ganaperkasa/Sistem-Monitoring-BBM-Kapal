@extends('layouts.app')
@section('content')

<div class="container-fluid overflow-hidden"> {{-- 🔥 PENTING --}}

    <!-- Row 1 -->
    <div class="row g-3">
        <div class="col-6 col-md-3">
            <div class="card p-3 h-100">
                <h6 class="card-title fw-semibold fs-6">Total CO2</h6>
                <h4 class="mb-0">{{ number_format($total_co2, 2) }}</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card p-3 h-100">
                <h6 class="card-title fw-semibold fs-6">Total NOx</h6>
                <h4 class="mb-0">{{ number_format($total_nox, 2) }}</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card p-3 h-100">
                <h6 class="card-title fw-semibold fs-6">Total SOx</h6>
                <h4 class="mb-0">{{ number_format($total_sox, 2) }}</h4>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card p-3 h-100">
                <h6 class="card-title fw-semibold fs-6">Rata-rata CII</h6>
                <h4 class="mb-0">{{ number_format($avg_cii, 6) }}</h4>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card w-100">
                <div class="card-body p-2 p-md-3"> {{-- 🔥 padding kecil di HP --}}
                    <h5 class="card-title fw-semibold fs-6 fs-md-5 mb-2">Grafik Emisi</h5>
                    <div id="chart" style="width:100%; max-width:100%;"></div> {{-- 🔥 FIX --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-2 p-md-3">
                    <h5 class="card-title fw-semibold fs-6 fs-md-5">Data Terakhir</h5>

                    <div class="table-responsive"> {{-- 🔥 WAJIB --}}
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kapal</th>
                                    <th>CO2</th>
                                    <th>NOx</th>
                                    <th>SOx</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent as $item)
                                    <tr>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $item->jenis_kapal }}</td>
                                        <td>{{ $item->co2 }}</td>
                                        <td>{{ $item->nox }}</td>
                                        <td>{{ $item->sox }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="py-4 text-center">
        <p class="mb-0 fs-6">GP Dev - Copyright 2026</p>
    </div>

</div> {{-- 🔥 PENUTUP container-fluid --}}

@endsection

@push('scripts')
<script>
    window.chartData = @json($chart);
</script>
@endpush
