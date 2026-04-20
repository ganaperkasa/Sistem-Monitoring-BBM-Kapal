@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Input Data Jenis BBM Kapal</h5>

        <form action="{{ url('/jenisbbm/store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Jenis BBM</label>
                <input type="text" name="jenis_bbm" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Faktor Emisi CO2</label>
                <input type="text" name="faktor_emisi" class="form-control" placeholder="Contoh: 3.114 atau 3,114">
            </div>

            <div class="mb-3">
                <label class="form-label">sulfur</label>
                <input type="text" name="sulfur" class="form-control" placeholder="Contoh: 0.005 atau 0,005">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <script id="m1y4qk">
document.querySelector('input[name="faktor_emisi"]').addEventListener('input', function(e) {
    this.value = this.value.replace(',', '.');
});

document.querySelector('input[name="sulfur"]').addEventListener('input', function(e) {
    this.value = this.value.replace(',', '.');
});
</script>

    </div>
</div>
@endsection

