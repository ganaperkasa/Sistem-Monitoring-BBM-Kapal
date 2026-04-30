@extends('layouts.app')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-auto-close show" role="alert">
            <strong>Sukses!</strong> {{ $message }}
        </div>
    @endif
    <div class="card">

        <div class="card-body">
            <h5 class="card-title fw-semibold ">Data Operasional Kapal</h5>
            {{-- <div class="d-flex justify-content-end ">

                <a href="{{ route('operasional.create') }}" class="btn btn-primary mb-2">
                    + Tambah Data
                </a>
            </div> --}}
            <div class="table-responsive">
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jenis Kapal</th>
                            <th>Tahun Kapal</th>
                            <th>Kapasitas Kapal (GT)</th>
                            <th>Kecepatan Kapal (Rpm)</th>
                            <th>Daya Mesin (kW)</th>
                            <th>Lama Operasi(Jam)</th>
                            <th>Jarak Tempuh (NM)</th>
                            <th>Konsumsi BBM (Ton)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>


    </div>
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
@endsection

@push('scripts')
    <script>
         window.chartData = @json($chart);
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('operasional.data') }}",
                columns: [{
                        data: 'jenis_kapal'
                    },
                    {
                        data: 'tahun_kapal'
                    },
                    {
                        data: 'kapasitas_kapal'
                    },
                    {
                        data: 'rpm'
                    },
                    {
                        data: 'daya_mesin'
                    },
                    {
                        data: 'lama_operasi'
                    },
                    {
                        data: 'jarak_tempuh'
                    },
                    {
                        data: 'konsumsi_bbm'
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            console.log(window.chartData);
        });
    </script>
@endpush
