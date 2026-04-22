@extends('layouts.app')

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Input Data Operasional Kapal</h5>

        <form action="{{ url('/operasional/store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Jenis Kapal</label>
                <input type="text" name="jenis_kapal" value="{{ old('jenis_kapal') }}"class="form-control @error('jenis_kapal') is-invalid @enderror" required>
                @error('jenis_kapal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Kapal</label>
                <input type="number" name="tahun_kapal" id="tahun_kapal" value="{{ old('tahun_kapal') }}"class="form-control @error('tahun_kapal') is-invalid @enderror" required>
                @error('tahun_kapal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kapasitas Kapal</label>
                <input type="number" name="kapasitas_kapal" value="{{ old('kapasitas_kapal') }}"class="form-control @error('kapasitas_kapal') is-invalid @enderror" required>
                @error('kapasitas_kapal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Area Pelayaran</label>
                <select name="area" id="area" class="form-control">
                    <option value="non_eca">Non-ECA</option>
                    <option value="eca">ECA</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tier IMO</label>
                <input type="text" id="tier" class="form-control" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">RPM</label>
                <input type="number" name="rpm" value="{{ old('rpm') }}"class="form-control @error('rpm') is-invalid @enderror" required>
                @error('rpm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Daya Mesin (kW)</label>
                <input type="number" step="0.01" name="daya_mesin" value="{{ old('daya_mesin') }}"class="form-control @error('daya_mesin') is-invalid @enderror" required>
                @error('daya_mesin')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Lama Operasi (Jam)</label>
                <input type="number" step="0.01" name="lama_operasi" value="{{ old('lama_operasi') }}"class="form-control @error('lama_operasi') is-invalid @enderror" required>
                @error('lama_operasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jarak Tempuh (NM)</label>
                <input type="number" name="jarak_tempuh" value="{{ old('jarak_tempuh') }}"class="form-control @error('jarak_tempuh') is-invalid @enderror" required>
                @error('jarak_tempuh')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Konsumsi BBM (Ton)</label>
                <input type="number"  name="konsumsi_bbm" value="{{ old('konsumsi_bbm') }}"class="form-control @error('konsumsi_bbm') is-invalid @enderror" required>
                @error('konsumsi_bbm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis BBM</label>
                <select name="jenis_bbm_id" class="form-control" required>
                    <option value="">-- Pilih BBM --</option>
                    @foreach($bbm as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->jenis_bbm }} | CO₂: {{ $item->faktor_emisi }} | S: {{ $item->sulfur }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan & Hitung</button>
        </form>
    </div>
</div>

<script>
function hitungTier() {
    let tahun = parseInt(document.getElementById('tahun_kapal').value);
    let area = document.getElementById('area').value;
    let tier = '';

    if (tahun < 2011) {
        tier = 'Tier I';
    } else if (tahun >= 2011 && tahun < 2016) {
        tier = 'Tier II';
    } else {
        tier = (area === 'eca') ? 'Tier III' : 'Tier II';
    }

    document.getElementById('tier').value = tier;
}

document.getElementById('tahun_kapal').addEventListener('input', hitungTier);
document.getElementById('area').addEventListener('change', hitungTier);
</script>

@endsection
