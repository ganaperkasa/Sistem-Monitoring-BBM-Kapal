@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold ">Tambah Jenis BBM</h5>
            <div class="d-flex justify-content-end ">

            <a href="{{ route('jenisbbm.create') }}" class="btn btn-primary mb-2" >
                + Tambah Data
            </a>
        </div>
            <div class="table-responsive">
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Jenis Fuel</th>
                            <th>Faktor Emisi CO2</th>
                            <th>Sulfur (%)</th>
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
        ajax: "{{ url('/jenis-bbm/data') }}",
        columns: [
            { data: 'jenis_bbm' },
            { data: 'faktor_emisi' },
            { data: 'sulfur' },
            { data: 'aksi', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
