@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Input Data Operasional Kapal</h5>

        <form action="{{ url('/operasional/store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kapal</label>
                <input type="text" name="nama_kapal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Lama Operasi (Jam)</label>
                <input type="number" step="0.01" name="lama_operasi" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jarak Tempuh (Mil Laut)</label>
                <input type="number" step="0.01" name="jarak_tempuh" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konsumsi BBM (Liter)</label>
                <input type="number" step="0.01" name="konsumsi_bbm" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>
</div>
@endsection
