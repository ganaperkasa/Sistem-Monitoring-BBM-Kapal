@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold ">Sample Page</h5>
            <div class="d-flex justify-content-end ">

            <a href="{{ route('operasional.create') }}" class="btn btn-primary mb-2" >
                + Tambah Data
            </a>
        </div>
            <div class="table-responsive">
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Kapal</th>
                            <th>Tanggal</th>
                            <th>Lama Operasi</th>
                            <th>Jarak</th>
                            <th>Konsumsi</th>
                            <th>CO2</th>
                            <th>Efisiensi</th>
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
        ajax: "{{ url('/operasional/data') }}",
        columns: [
            { data: 'nama_kapal' },
            { data: 'tanggal' },
            { data: 'lama_operasi' },
            { data: 'jarak_tempuh' },
            { data: 'konsumsi_bbm' },
            { data: 'co2' },
            { data: 'efisiensi' },
            { data: 'aksi', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
