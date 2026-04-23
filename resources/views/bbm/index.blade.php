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
            <div class="d-flex justify-content-end ">

                <a href="{{ route('operasional.create') }}" class="btn btn-primary mb-2">
                    + Tambah Data
                </a>
            </div>
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
@endsection
@push('scripts')
    <script>
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
        });
    </script>
@endpush
